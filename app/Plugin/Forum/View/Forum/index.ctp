<?php 

$this->Html->addCrumb($settings['site_name'], array('controller' => 'forum', 'action' => 'index'));

if (!empty($forums)) {
	foreach ($forums as $forum) { ?>

<div class="container" id="forum-<?php echo $forum['Forum']['id']; ?>">
	<div class="containerHeader">
		<a href="javascript:;" onclick="return Forum.toggleForums(this, <?php echo $forum['Forum']['id']; ?>);" class="toggle">-</a>
		<h3><?php echo $forum['Forum']['title']; ?></h3>
	</div>
    
	<div class="containerContent" id="forums-<?php echo $forum['Forum']['id']; ?>">
		<table cellspacing="0" class="table forums">
			<tbody>

			<?php if (!empty($forum['Children'])) {
				foreach ($forum['Children'] as $counter => $child) {
					echo $this->element('tiles/forum_row', array(
						'forum' => $child,
						'counter' => $counter
					));
				}
			} else { ?>

				<tr>
					<td colspan="5" class="empty"><?php echo __d('forum', 'There are no categories within this forum.'); ?></td>
				</tr>

			<?php } ?>

			</tbody>
		</table>
	</div>
</div>

<?php } } ?>

