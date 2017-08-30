<h3><?php echo 'Fragebogen '.$formData['Form']['title']; ?> Statistiken</h3>
<div class="actions">
    <?php
    echo $this->Html->link(
        $this->Html->image("admin/user.gif") . 'Zurück zum Fragebogen',
        array('action' => 'view', $formData['Form']['id']),
        array('escape' => false)
    );
    ?>
</div>


<h3>Fragen</h3>
<?php if(!empty($formData['Question'])):?>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th colspan="2">Frage</th>
        </tr>
        <?php
        $length = count($formData['Question']) - 1;
        foreach ($formData['Question'] as $key => $question):
            if($key == 0) $visible1 = 'visibility:hidden';
            else $visible1 = '';
            if($key == $length) $visible2 = 'visibility:hidden';
            else $visible2 = '';
            ?>
            <tr>
                <td><?php echo $key + 1; ?>.</td>
                <td><?php echo $question['question'];?> <br /><b>Beantwortet von <?php echo $question['user_count'] ?> Benutzern</b><br />
                    <table>
                        <tr>
                            <th style="width: 5%;">Nr.</th>
                            <th style="width: 75%;">Antwort</th>
                            <th style="width: 20%;">Anzahl Benutzer</th>
                        </tr>
                        <?php foreach($question['Answers'] as $a_key => $answer): ?>
                            <tr <?php if($answer['correct']): ?> class="correct"<?php endif; ?>>
                                <td><?php echo $a_key+1 ?></td>
                                <td><?php echo $answer['title'] ?></td>
                                <td><?php echo $answer['user_count'] ?></td>
                            </tr>
                        <?php endforeach; ?>


                    </table>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>