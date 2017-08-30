<?php
define('ENTRIES_PER_PAGE', 21);
define('ENTRIES_PER_ROW', 3);
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
		.item2015
		{
			padding: 10px;
			width: 200px;
			height: 220px;
			float: left;
			border: 1px solid rgb(210, 210, 210);
			margin-right: 6px;
			margin-bottom: 20px;
			box-sizing: border-box;
		}
		.item2015.top3
		{
			background: rgb(240, 240, 240);
			border: 1px solid #004C9D;
		}
		.item2015 .foto,
		.item2015 .name,
		.item2015 .points,
		.item2015 .pokal,
		.item2015 .more
		{
			font-size: 12px;
			background: none;
			margin: 0 auto;
			padding: 0;
			text-align: center;
			white-space: nowrap;
		}
		.item2015 .foto
		{
			min-height: 65px;
		}
		.item2015 .name
		{
			font-weight: bold;
			padding: 10px 0;
		}
		.item2015 .points
		{
			padding-bottom: 10px;
		}

		.item2015 .pokal
		{
			padding-top: 10px;
			color: white;
			font-size: 20px;
			width: 65px;
			height: 75px;
			background: url('/img/pokal2015.svg') no-repeat;
			float: right;
		}
		.item2015 a.button
		{
			border-radius: 4px;
			width: 84px;
			height: 28px;
			line-height: 28px;
			background: #092759;
			background-image: -moz-linear-gradient(to bottom, rgb(32, 74, 116), rgb(13, 51, 96));
			background-image: -webkit-linear-gradient(top, rgb(32, 74, 116), rgb(13, 51, 96));
			background-image: linear-gradient(top, rgb(32, 74, 116), rgb(13, 51, 96));
			color: white !important;
			font-size: 16px;
			font-family: Verdana, Helvetica, Arial, sans-serif;
			letter-spacing: 0.2px;
			font-weight: lighter;
			border: none;
			float: none;
			margin: 10px auto;
		}
		.item2015 a.button.top3
		{
			float: left;
			margin-top: 45px;
		}
		.paging.center
		{
			float: none !important;
			margin: 10px auto;
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
$page = isset($this->params['named']['page']) ? (int)$this->params['named']['page'] : 1;
$i    = $page;
if ($page > 1)
{
	$i = ENTRIES_PER_PAGE * ($page - 1);
}

foreach ($users as $user)
{
	$data    = $user;
	$percent = round($user['UserCatalog']['points'] / MAX_POINTS * 100, 1);
	$profile = "{$this->base}/users/view/{$data['User']['id']}/$year";

	$picture = '';
	if ($user['UserProfile']['picupload'])
	{
		$image   = DS . 'files' . DS . 'user_profile' . DS . 'picupload' . DS . $user['UserProfile']['id'] . DS . 'thumb_' . $user['UserProfile']['picupload'];
		$picture = $this->Html->image($image);
	}

	if ($user['UserCatalog']['rank'] <= SPECIAL_RANKS && $i <= SPECIAL_RANKS)
	{
		?>
		<div class="item2015 top3">
			<div class="foto"><?php echo $picture; ?></div>
			<div
				class="name"><?php echo $data['UserProfile']['firstname'], ' ', $data['UserProfile']['surname']; ?></div>
			<div
				class="points"><?php echo $user['UserCatalog']['points'], ' erreichte Punkte (', $percent, '%)'; ?></div>
			<div class="more">
				<a class="button top3" href="<?php echo $profile; ?>">mehr ...</a>
			</div>
			<div class="pokal">
				<?php echo $user['UserCatalog']['rank'] ?>
			</div>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="item2015">
			<div class="foto"><?php echo $picture; ?></div>
			<div class="name"><?php echo $data['UserProfile']['firstname'], ' ', $data['UserProfile']['surname']; ?></div>
			<div class="points"><?php echo $user['UserCatalog']['rank'] ?>. Platz</div>
			<div class="points"><?php echo $user['UserCatalog']['points'], ' erreichte Punkte (', $percent, '%)'; ?></div>
			<div class="more">
				<a class="button" href="<?php echo $profile; ?>">mehr ...</a>
			</div>
		</div>

		<?php
	}
	$i++;
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