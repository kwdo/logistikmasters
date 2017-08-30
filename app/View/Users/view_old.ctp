<?php
$GLOBALS['title'] = utf8_decode('Katalog - Best Azubi');
$data             = $user;
$noValueText      = 'keine Angabe';
foreach ($data as $key => $value)
{
    if (!$value)
    {
        $data[$key] = $noValueText;
    }
    else
    {
        $data[$key] = $value;
    }
}
$image = '';
if ($user['UserProfile']['picupload'])
{
    $image = DS . 'files' . DS . 'user_profile' . DS . 'picupload' . DS . $user['UserProfile']['id'] . DS . 'large_' . $user['UserProfile']['picupload'];
}
?>

<div class="UserView">
    <div class="infobox">
        <?php
        if ($image)
        {
            echo $this->Html->image($image, array('class' => 'catalog'));
        }
        ?>
        <div class="userOverview">
            <h3><?php echo strip_tags($data['UserProfile']['firstname'] . ' ' . $data['UserProfile']['surname']); ?></h3>
            <span><?php echo $user['UserCatalog']['rank'] ?>. Platz im Best Azubi Wettbewerb <?php echo $year + 2000 ?></span>
            <dl class="catalog">
                <dt>Nationalität</dt>
                <dd><?php echo vitaValueFormatter($data['UserProfile']['national']) ?>&nbsp;</dd>
                <dt>Geburtsdatum</dt>
                <dd><?php echo (strip_tags($data['UserProfile']['birthdate']) == '0000-00-00') ? 'keine Angabe' : $this->Time->format("d.m.Y", strip_tags($data['UserProfile']['birthdate'])) ?>&nbsp;</dd>
                <dt>Geburtsort/-land</dt>
                <dd><?php echo vitaValueFormatter($data['UserProfile']['birthcity']) ?>&nbsp;</dd>
            </dl>
        </div>
        <div class="clear"></div>
    </div>

    <h2>Ergebnisse bei Bestazubi <?php echo $year + 2000 ?></h2>
    <dl class="catalog">
        <dt>Erreichte Punktzahl</dt>
        <dd><?php echo $user['UserCatalog']['points'] ?> Punkte</dd>
        <dt>Rang</dt>
        <dd><?php echo $user['UserCatalog']['rank'] ?></dd>
    </dl>

    <h2>Ausbildungsbetrieb</h2>
    <dl class="catalog">
        <dt>Name des Betriebs</dt>
        <dd><?php echo vitaValueFormatter($data['UserProfile']['company']) ?>&nbsp;</dd>
        <dt>Ort</dt>
        <dd><?php echo vitaValueFormatter($data['UserProfile']['company_city']) ?>&nbsp;</dd>
    </dl>
    <h2>Besuchte Hochschule</h2>
    <dl class="catalog">
        <dt>Name der Hochschule</dt>
        <dd><?php echo vitaValueFormatter($data['UserProfile']['School']['name']) ?>&nbsp;</dd>
        <dt>Ort</dt>
        <dd><?php echo vitaValueFormatter($data['UserProfile']['School']['SchoolCity']['name']) ?>&nbsp;</dd>
    </dl>
    <h2>Interessen</h2>
    <dl class="catalog">
        <dd><?php echo vitaValueFormatter($data['UserProfile']['interessen']) ?></dd>
    </dl>
    <h2>Zukunftspl&auml;ne</h2>
    <dl class="catalog">
        <dd><?php echo vitaValueFormatter($data['UserProfile']['zukunftsplaene']) ?></dd>
    </dl>

    <hr class="spacertop" />

    <?php
    echo $this->Html->link('Zum Kontaktformular', array('action' => 'contact', $user['User']['id']), array('class' => 'boxLink', 'style' => 'float:left'));
    echo $this->Html->link('Zurück zur Übersicht', array('action' => 'index', 0, $year), array('class' => 'boxLink gray'));
    ?>

</div>
<?php

function vitaTimeFormatter($from, $to, $values, $data, $time, $noValueText)
{
    static $counter = 0;
    $output  = '';

    $validValues = false;
    foreach ($values as $val)
    {
        if ($val != $noValueText)
        {
            $validValues = true;
            break;
        }
    }

    if ($validValues)
    {
        $fromDate   = ($data[$from] == '0000-00-00' || $data[$from] == $noValueText) ? $noValueText : $time->format("m/Y", $data[$from]);
        $toDate     = ($data[$to] == '0000-00-00' || $data[$to] == $noValueText) ? $noValueText : $time->format("m/Y", $data[$to]);
        $dateString = '';
        if ($fromDate == $noValueText && $toDate == $noValueText)
        {
            $dateString = $noValueText;
        }
        elseif ($fromDate != $toDate)
        {
            $dateString = "$fromDate - $toDate";
        }
        $output .= "<dt class=\"normal\">$dateString</dt>" . PHP_EOL;
        $output .= '<dd>' . PHP_EOL;
        $i          = 0;
        foreach ($values as $key)
        {
            $val = $data[$key];
            if ($val != $noValueText)
            {
                if ($i)
                {
                    $output .= '<br />' . PHP_EOL;
                }
                $output .= strip_tags($val);
                $i++;
            }
        }
        $output .= '</dd>' . PHP_EOL;
        if (!$i)
        {
            return '';
        }
        if ($counter)
        {
            $output = '<br />' . PHP_EOL . $output;
        }
        $counter++;
    }
    return $output;
}

function vitaValueFormatter($value)
{
    if (!$value || $value == 'keine Angabe')
    {
        return 'keine Angabe';
    }
    else
    {
        return strip_tags($value);
    }
}

function vitaExtraSkillFormatter($skills)
{
    $output = '';
    $lines  = explode(PHP_EOL, $skills);
    foreach ($lines as $line)
    {
        $line = trim($line);
        $pos  = stripos($line, '(');
        if ($pos !== false)
        {
            $dt = substr($line, 0, $pos);
            $dd = substr($line, $pos + 1, -1);
            $output .= "<dt class=\"normal\">" . strip_tags(trim($dt)) . "</dt>" . PHP_EOL;
            $output .= "<dd>" . strip_tags(trim($dd)) . "</dd>" . PHP_EOL;
        }
    }
    return $output;
}
?>