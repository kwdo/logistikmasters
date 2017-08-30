<?php
	$GLOBALS['noFrontEndStyles'] = true;
	$GLOBALS['title'] = utf8_decode('Katalog - LOGISTIK MASTERS');
	$data = $user['UserProfile'];
	$noValueText = '-';

	foreach ($data as $key => $value) {
		if (!$value) {
			$data[$key] = $noValueText;
		}
		else {
			$data[$key] = $value;
		}
	}

	$image = '';
	if ($user['UserProfile']['picupload']) {
		$image = DS . 'files' . DS . 'user_profile' . DS . 'picupload' . DS . $user['UserProfile']['id'] . DS . 'large_' . $user['UserProfile']['picupload'];
		$image = $this->Html->image($image, array('class' => 'catalog'));
	}
?>
	<div class="UserView">
		<div class="infobox">
			<?php echo $image; ?>
			<div class="userOverview">
				<h3><?php if($user['UserCatalog']['display']): ?><?php echo $user['UserProfile']['firstname'], ' ', $user['UserProfile']['surname']; ?><?php else: ?>k.A.<?php endif; ?></h3>
				<span><?php echo $user['UserCatalog']['rank'] ?>. Platz im LOGISTIK MASTERS Wettbewerb</span>
				<dl class="catalog">
					<dt>Nationalität</dt>
					<dd><?php echo Sanitize::html($data['nationality']) ?>&nbsp;</dd>
					<dt>Geburtsdatum</dt>
					<dd><?php echo ($data['birthdate'] == '0000-00-00' || $data['birthdate'] == '1999-01-01' || $data['birthdate'] == $noValueText) ? $noValueText : CakeTime::format("d.m.Y", $data['birthdate']) ?>
						&nbsp;</dd>
					<dt>Geburtsort/-land</dt>
					<dd><?php echo Sanitize::html($data['birthland']) ?>&nbsp;</dd>
				</dl>
			</div>
			<div class="clear"></div>
		</div>

		<h2>Gesuchte Tätigkeit</h2>
		<dl class="catalog">
			<dt>Frühestm&ouml;glicher Einsatztermin</dt>
			<dd><?php echo ($data['einsatztermin'] == '0000-00-00' || $data['einsatztermin'] == '1999-01-01' || $data['einsatztermin'] == $noValueText) ? $noValueText : CakeTime::format("d.m.Y", $data['einsatztermin']) ?>
				&nbsp;</dd>
			<dt>Gewünschter Einsatzort</dt>
			<dd><?php echo $data['einsatzort'] ?>&nbsp;</dd>
			<dt>Gewünschte Beschäftigungsart</dt>
			<dd><?php echo Sanitize::html($data['beschaeftigungsart']) ?>&nbsp;</dd>
			<dt>Karrierestatus</dt>
			<dd><?php echo Sanitize::html($data['karrierestatus']) ?>&nbsp;</dd>
		</dl>

		<h2>Ergebnisse bei LOGISTIK MASTERS</h2>
		<dl class="catalog">
			<dt>Erreichte Punktzahl</dt>
			<dd><?php echo Sanitize::html($user['UserCatalog']['points'] . ' (' . round($user['UserCatalog']['points'] / MAX_POINTS * 100, 1) . '%)') ?>
				&nbsp;</dd>
			<dt>Rang</dt>
			<dd><?php echo Sanitize::html($user['UserCatalog']['rank']) ?>&nbsp;</dd>
		</dl>

		<h2>Hochschule</h2>
		<dl class="catalog">
			<?php
				echo vitaTimeFormatter('begineducation', 'endeducation', array($data['School']['name'], $data['School']['SchoolCity']['name']), $data, $noValueText, false);
			?>
			<dt>Fachbereich</dt>
			<dd><?php echo Sanitize::html($data['branchofstudy']) ?>&nbsp;</dd>
			<dt>Abschluss</dt>
			<dd><?php echo Sanitize::html($data['graduation']) ?>&nbsp;</dd>
			<dt>Thema der Abschlussarbeit</dt>
			<dd><?php echo Sanitize::html($data['themeofdissertation']) ?>&nbsp;</dd>
			<dt>Abschlussnote</dt>
			<dd><?php echo Sanitize::html($data['abschlussnote']) ?>&nbsp;</dd>
		</dl>

		<dl class="catalog">
			<?php
				echo vitaTimeFormatter('school2_begineducation', 'school2_endeducation', array($data['school2_name'], $data['school2_city']), $data, $noValueText, false);
				echo vitaTimeFormatter('', '', array('school2_company', 'school2_company_city'), $data, $noValueText, true);
			?>
			<dt>Abschluss</dt>
			<dd><?php echo Sanitize::html($data['school2_graduation']) ?>&nbsp;</dd>
			<dt>Thema der Abschlussarbeit</dt>
			<dd><?php echo Sanitize::html($data['school2_themeofdissertation']) ?>&nbsp;</dd>
			<dt>Abschlussnote</dt>
			<dd><?php echo Sanitize::html($data['school2_abschlussnote']) ?>&nbsp;</dd>
		</dl>

		<h2>Absolvierte Praktika</h2>
		<dl class="catalog">
			<?php
				echo vitaTimeFormatter('beginnp1', 'endep1', array('unternehmenp1', 'taetigkeitp1'), $data, $noValueText, true);
				echo vitaTimeFormatter('beginnp2', 'endep2', array('unternehmenp2', 'taetigkeitp2'), $data, $noValueText, true);
				echo vitaTimeFormatter('beginnp3', 'endep3', array('unternehmenp3', 'taetigkeitp3'), $data, $noValueText, true);
			?>
		</dl>

		<h2>Sprachkenntnisse</h2>
		<dl class="catalog">
			<?php
				echo vitaLanguageFormatter('sprache1', 'sprache1kenntnisse', $data, $noValueText, true);
				echo vitaLanguageFormatter('sprache2', 'sprache2kenntnisse', $data, $noValueText, true);
				echo vitaLanguageFormatter('sprache3', 'sprache3kenntnisse', $data, $noValueText, true);
				echo vitaLanguageFormatter('sprache4', 'sprache4kenntnisse', $data, $noValueText, true);
				echo vitaLanguageFormatter('sprache5', 'sprache5kenntnisse', $data, $noValueText, true);
			?>
		</dl>

		<h2>Sonstige Kenntnisse</h2>

		<div class="catalog" style="margin: 0 0 20px 55px;">
			<?php echo nl2br($data['sonstigekenntnisse']); ?>
		</div>

		<?php
			echo $this->Html->link('Zum Kontaktformular', array('action' => 'contact', $user['User']['id']), array('class' => 'boxLink', 'style' => 'float:left'));
			echo $this->Html->link('Zurück zur Übersicht', array('action' => 'index', 0, $year), array('class' => 'boxLink gray'));
		?>

	</div>
<?php
	function vitaTimeFormatter($from, $to, $values, $data, $noValueText, $extract)
	{
		static $counter = 0;
		$output = '';

		$validValues = false;
		foreach ($values as $val) {
			if ($val != $noValueText) {
				$validValues = true;
				break;
			}
		}

		if ($validValues) {
			$fromDate = '';
			$toDate   = '';
			if (isset($data[$from])) {
				$fromDate = ($data[$from] == '0000-00-00' || $data[$from] == '1999-01-01' || $data[$from] == $noValueText) ? $noValueText : CakeTime::format("m/Y", $data[$from]);
			}
			if (isset($data[$to])) {
				$toDate = ($data[$to] == '0000-00-00' || $data[$from] == '1999-01-01' || $data[$to] == $noValueText) ? $noValueText : CakeTime::format("m/Y", $data[$to]);
			}
			$dateString = '';
			if ($fromDate == $noValueText && $toDate == $noValueText) {
				$dateString = $noValueText;
			}
			elseif ($fromDate != $toDate) {
				$dateString = "$fromDate - $toDate";
			}
			$output .= "<dt class=\"normal\">$dateString</dt>" . PHP_EOL;
			$output .= '<dd>' . PHP_EOL;
			$i = 0;
			foreach ($values as $key) {
				if ($extract) {
					$val = isset($data[$key]) ? $data[$key] : '';
				}
				else {
					$val = $key;
				}
				if ($val != $noValueText) {
					if ($i) {
						$output .= '<br />' . PHP_EOL;
					}
					$output .= Sanitize::html($val);
					$i++;
				}
			}
			$output .= '</dd>' . PHP_EOL;
			if (!$i) {
				return '';
			}
			if ($counter) {
				$output = '<br />' . PHP_EOL . $output;
			}
			$counter++;
		}
		return $output;
	}

	function vitaLanguageFormatter($language, $skill, $data, $noValueText)
	{
		$output = '';
		if ($data[$language] != $noValueText && $data[$skill] != $noValueText) {
			$output .= "<dt class=\"normal\">" . Sanitize::html($data[$language]) . "</dt>" . PHP_EOL;
			$output .= "<dd>" . Sanitize::html($data[$skill]) . "</dd>" . PHP_EOL;
		}
		return $output;
	}

	function vitaExtraSkillFormatter($skills)
	{
		$output = '';
		$lines  = explode(PHP_EOL, $skills);

		foreach ($lines as $line) {
			$line = trim($line);
			$pos  = stripos($line, '(');
			if ($pos !== false) {
				$dt = substr($line, 0, $pos);
				$dd = substr($line, $pos + 1, -1);
				$output .= "<dt class=\"normal\">" . Sanitize::html(trim($dt)) . "</dt>" . PHP_EOL;
				$output .= "<dd>" . Sanitize::html(trim($dd)) . "</dd>" . PHP_EOL;
			}
		}
		return $output;
	}
