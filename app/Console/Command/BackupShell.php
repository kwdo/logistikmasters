<?php
App::uses('ConnectionManager', 'Model');

/**
 * BackupShell class
 *
 * @uses          Shell
 * @package       cakephp-backupshell
 */
class BackupShell extends Shell
{


    public function main()
    {

        $configCustom = Configure::read('custom_settings');

        // Closed? We don't have to backup
        if (time() < $configCustom['competion_end']) {

            //rows per query (less rows = less ram usage but more running time), default is 0 which means all rows
            if (!isset($this->args[0])) {
                $this->args[0] = 1000;
            }

            $db = ConnectionManager::getDataSource('default');
            $backupdir = '/u01/htdocs/backups/logistikmasters/';

            $sources = $db->query("show full tables where Table_Type = 'BASE TABLE'", false);
            foreach ($sources as $table) {
                $table = array_shift($table);
                $tables[] = array_shift($table);
            }


            $filename = 'db-backup-' . date('Y-m-d', time()) . '.sql';

            $return = '';
            $limit = $this->args[0];
            $start = 0;

            if (!is_dir($backupdir)) {
                $this->out(' ', 1);
                $this->out('Will create "' . $backupdir . '" directory!', 2);
                if (mkdir($backupdir, 0755, true)) {
                    $this->out('Directory created!', 2);
                } else {
                    $this->out('Failed to create destination directory! Can not proceed with the backup!', 2);
                    die;
                }
            }

            if ($this->__isDbConnected('default')) {

                $this->out('---------------------------------------------------------------');
                $this->out(' Starting Backup..');
                $this->out('---------------------------------------------------------------');

                foreach ($tables as $table) {
                    $this->out(" ", 2);
                    $this->out($table);

                    $handle = fopen($backupdir . '/' . $filename, 'a+');
                    $return = 'DROP TABLE IF EXISTS `' . $table . '`;';

                    $row2 = $db->query('SHOW CREATE TABLE ' . $table . ';');
                    //$this->out($row2);
                    $return .= "\n\n" . $row2[0][0]['Create Table'] . ";\n\n";
                    fwrite($handle, $return);

                    for (; ;) {
                        if ($limit == 0) {
                            $limitation = '';
                        } else {
                            $limitation = ' Limit ' . $start . ', ' . $limit;
                        }

                        $result = $db->query('SELECT * FROM ' . $table . $limitation . ';', false);
                        $num_fields = count($result);


                        if ($num_fields == 0) {
                            $start = 0;
                            break;
                        }

                        foreach ($result as $row) {
                            $return2 = 'INSERT INTO ' . $table . ' VALUES(';
                            $j = 0;
                            foreach ($row[$table] as $key => $inner) {
                                $j++;
                                if (isset($inner)) {
                                    if ($inner == NULL) {
                                        $return2 .= 'NULL';
                                    } else {
                                        $inner = addslashes($inner);
                                        $inner = ereg_replace("\n", "\\n", $inner);
                                        $return2 .= '"' . $inner . '"';
                                    }
                                } else {
                                    $return2 .= '""';
                                }

                                if ($j < (count($row[$table]))) {
                                    $return2 .= ',';
                                }
                            }
                            $return2 .= ");\n";
                            fwrite($handle, $return2);

                        }
                        $start += $limit;
                        if ($limit == 0) {
                            break;
                        }
                    }

                    $return .= "\n\n\n";
                    fclose($handle);
                }

                $this->out(" ", 2);
                $this->out('---------------------------------------------------------------');
                $this->out(' Yay! Backup Completed!');
                $this->out('---------------------------------------------------------------');


                // Prepare File
                $zipFile = $backupdir . '/' . $filename . '.zip';
                $zip = new ZipArchive();
                $zip->open($zipFile, ZipArchive::OVERWRITE);

                $zip->addFile($backupdir . '/' . $filename, $filename);

                // Close and send to users
                $zip->close();
                unlink($backupdir . '/' . $filename);

                $this->out(" ", 2);
                $this->out('---------------------------------------------------------------');
                $this->out(' File zipped!');
                $this->out('---------------------------------------------------------------');


            } else {
                $this->out(' ', 2);
                $this->out('Error! Can\'t connect to Logistik Masters database!', 2);
            }
        }
    }

    function __isDbConnected($db = NULL)
    {
        $datasource = ConnectionManager::getDataSource($db);
        return $datasource->isConnected();
    }

}

?>