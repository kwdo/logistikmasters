<?php
define('ENTRIES_PER_PAGE', 10);
define('ENTRIES_PER_ROW', 1);
define('SPECIAL_RANKS', 3);

$GLOBALS['title'] = utf8_decode('Katalog - Best Azubi');
App::import('Sanitize');

if (!$maxPoints)
{
    $maxPoints = 1;
}
echo $this->Paginator->options(array('url' => array('year' => $year, 'occupation' => $occupation)));
?>
    <style>
        .wrapperBachelor,
        .wrapperMaster
        {
            width: 260px;
            float: left;
        }

        .wrapperBachelor
        {
            padding-right: 40px;
        }

        .wrapperMaster
        {
            border-left: 1px solid rgb(210, 210, 210);
            padding-left: 40px;
        }

        .item2016
        {
            position: relative;
            padding: 10px;
            width: 100%;
            height: 180px;
            float: left;
            border: 1px solid rgb(210, 210, 210);
            box-sizing: border-box;
            margin: 5px 0;
        }

        .item2016.top3
        {
            background: rgb(240, 240, 240);
            border: 1px solid #004C9D;
        }

        .item2016 .foto,
        .item2016 .name,
        .item2016 .points,
        .item2016 .pokal,
        .item2016 .more
        {
            font-size: 12px;
            background: none;
            margin: 0 auto;
            padding: 0;
            text-align: center;
        }

        .item2016 .fotopane
        {
            width: 80px;
            float: right;
        }

        .item2016 .foto
        {
            width: 80px;
            overflow: hidden;
            height: 110px;
            margin-bottom: 10px;
        }

        .item2016 .foto img
        {
            width: 100%;
        }

        .item2016 .name
        {
            font-weight: bold;
            color: #325B87;
            font-size: 13px;
            padding: 0;
        }

        .item2016 .points
        {
            padding-bottom: 10px;
        }

        .item2016 .pokal
        {
            clear: both;
            padding-top: 10px;
            color: white;
            font-size: 20px;
            width: 65px;
            height: 75px;
            background: url('/img/pokal2015.svg') no-repeat;
            margin: 0 50px;
            position: absolute;
            bottom: 10px;
        }

        .item2016 a.button
        {
            border-radius: 4px;
            width: 84px;
            height: 20px;
            line-height: 20px;
            background: #092759;
            background-image: -moz-linear-gradient(to bottom, rgb(32, 74, 116), rgb(13, 51, 96));
            background-image: -webkit-linear-gradient(top, rgb(32, 74, 116), rgb(13, 51, 96));
            background-image: linear-gradient(top, rgb(32, 74, 116), rgb(13, 51, 96));
            color: white !important;
            font-size: 12px;
            font-family: Verdana, Helvetica, Arial, sans-serif;
            letter-spacing: 0.2px;
            font-weight: lighter;
            border: none;
            float: right;
            margin: 10px auto;
        }

        .paging.center
        {
            float: none !important;
            margin: 10px auto;
        }

        h3.center
        {
            padding: 0 !important;
            text-align: center;
            margin: 20px 0;
        }

    </style>
    <div class="infobox">
        <?php echo $GLOBALS['controlArticle']['recruiting_text']; ?>
    </div>

    <div id="selectors">
        <?php echo $this->Form->create('User', array('id' => 'lmSearchForm')); ?>
        <div class="box half mr">
            <h3>Nach gesuchter Besch&auml;ftigungsart filtern</h3>

            <div class="content">
                <?php
                echo $this->Form->input('occupation', array('id'      => 'selectOccupation', 'empty' => PLEASE_SELECT,
                                                            'type'    => 'select', 'label' => '',
                                                            'options' => $occupations, 'selected' => $occupation
                ));
                ?>
                <div class="clear"></div>
            </div>
        </div>

        <div class="box half">
            <h3>Nach Recruitingkatalog filtern</h3>

            <div class="content">
                <?php
                $years = array();
                for ($i = FIRST_YEAR; $i <= (CURRENT_YEAR - 2000); $i++)
                {
                    $years[$i] = $i + 2000;
                }
                echo $this->Form->input('year', array('id'      => 'selectYear', 'type' => 'select', 'label' => '',
                                                      'options' => $years, 'selected' => $year
                ));
                ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

        </div>
        </form>
    </div>

    <div class="clear"></div>

    <script type="text/javascript">
        $(function ()
        {
            $("#selectYear").bind("change", function ()
            {
                document.location.href = "/users/index/occupation:" + $("#selectOccupation").val() + "/year:" + $("#selectYear").val();
            });

            $("#selectOccupation").bind("change", function ()
            {
                document.location.href = "/users/index/occupation:" + $("#selectOccupation").val() + "/year:" + $("#selectYear").val();
            });
        });
    </script>

    <h2 class="center blue borderless">Das sind die Top-Logistik-Studenten <?php echo $year + 2000 ?> im Logistik
        Masters Wettbewerb:</h2>
    <p>&nbsp;</p>
    <hr/>


<?php
foreach (array('Bachelor', 'Master') as $degree)
{
    $page = isset($this->params['named']['page']) ? (int)$this->params['named']['page'] : 1;
    $i    = $page;
    if ($page > 1)
    {
        $i = ENTRIES_PER_PAGE * ($page - 1);
    }
    echo "<div class='wrapper$degree'><h3 class='center h1-grau'>$degree</h3>";
    foreach ($$degree as $user)
    {
        // var_dump($user); break;
        $data = $user;
        $percent = round($user['UserCatalog']['points'] / MAX_POINTS * 100, 1);
        $profile = "{$this->base}/users/view/{$data['User']['id']}/$year";

        $picture = '';
        if ($user['UserProfile']['picupload'])
        {
            $image   = DS . 'files' . DS . 'user_profile' . DS . 'picupload' . DS . $user['UserProfile']['id'] . DS . 'large_' . $user['UserProfile']['picupload'];
            $picture = $this->Html->image($image);
        }

        if ($user['UserCatalog']['rank'] <= SPECIAL_RANKS && $i <= SPECIAL_RANKS)
        { // Kachel mit Pokal
            ?>
            <div class="item2016 top3">
                <div class="fotopane">
                    <div class="foto"><?php echo $picture; ?></div>
                    <div class="more">
                        <a class="button top3" href="<?php echo $profile; ?>">mehr ...</a>
                    </div>
                </div>
                <div class="name top3">
            <?php if($data['UserCatalog']['display']): ?><?php echo $data['UserProfile']['firstname'], ' ', $data['UserProfile']['surname']; ?><?php else: ?>k.A.<?php endif; ?>
                </div>
                <div class="points">
                    <?php echo $user['UserCatalog']['points'], ' erreichte Punkte<br>(', $percent, '%)'; ?>

                    <div class="pokal">
                        <?php echo $user['UserCatalog']['rank'] ?>
                    </div>
                </div>
            </div>
            <?php
        }
        else
        { // Normale Kachel
            ?>
            <div class="item2016">
                <div class="fotopane">
                    <div class="foto"><?php echo $picture; ?></div>
                    <div class="more">
                        <a class="button" href="<?php echo $profile; ?>">mehr ...</a>
                    </div>
                </div>
                <div class="name"><?php if($data['UserCatalog']['display']): ?><?php echo $data['UserProfile']['firstname'], ' ', $data['UserProfile']['surname']; ?><?php else: ?>k.A.<?php endif; ?></div>
                <div class="points">
                    <br>
                    <?php echo $user['UserCatalog']['rank'] ?>. Platz<br>
                    <?php echo $user['UserCatalog']['points'], ' erreichte Punkte<br>(', $percent, '%)'; ?>
                </div>
            </div>

            <?php
        }
        $i++;
    }
    echo '<div class="clear"></div></div>';
}
?>

    <div class="clear"></div>
<?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()): ?>
    <div class="paging center">
        <?php echo $this->Paginator->first('&laquo;', array('escape' => false), null); ?>
        <?php echo $this->Paginator->prev('&lsaquo;', array('escape' => false), null); ?>
        <?php echo $this->Paginator->numbers(); ?>
        <?php echo $this->Paginator->next('&rsaquo;', array('escape' => false), null); ?>
        <?php echo $this->Paginator->last('&raquo;', array('escape' => false), null); ?>
    </div>
<?php endif ?>