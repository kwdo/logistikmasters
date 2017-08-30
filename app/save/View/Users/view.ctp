<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datenschutz'); ?></dt>
		<dd>
			<?php echo h($user['User']['datenschutz']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doubleoptin Hash'); ?></dt>
		<dd>
			<?php echo h($user['User']['doubleoptin_hash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Doubleoptin'); ?></dt>
		<dd>
			<?php echo h($user['User']['doubleoptin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs'), array('controller' => 'user_catalogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalog'), array('controller' => 'user_catalogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs2011s'), array('controller' => 'user_catalogs2011s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalogs2011'), array('controller' => 'user_catalogs2011s', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs Olds'), array('controller' => 'user_catalogs_olds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalogs Old'), array('controller' => 'user_catalogs_olds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs Tmps'), array('controller' => 'user_catalogs_tmps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalogs Tmp'), array('controller' => 'user_catalogs_tmps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Points'), array('controller' => 'user_points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Point'), array('controller' => 'user_points', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Profiles'); ?></h3>
	<?php if (!empty($user['Profile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Street'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('School Id'); ?></th>
		<th><?php echo __('Company'); ?></th>
		<th><?php echo __('Company City'); ?></th>
		<th><?php echo __('Trainer Firstname'); ?></th>
		<th><?php echo __('Trainer Surname'); ?></th>
		<th><?php echo __('Year Of Apprenticeship'); ?></th>
		<th><?php echo __('Career Aspiration'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Profile'] as $profile): ?>
		<tr>
			<td><?php echo $profile['id']; ?></td>
			<td><?php echo $profile['user_id']; ?></td>
			<td><?php echo $profile['sex']; ?></td>
			<td><?php echo $profile['firstname']; ?></td>
			<td><?php echo $profile['surname']; ?></td>
			<td><?php echo $profile['street']; ?></td>
			<td><?php echo $profile['zip']; ?></td>
			<td><?php echo $profile['city']; ?></td>
			<td><?php echo $profile['phone']; ?></td>
			<td><?php echo $profile['school_id']; ?></td>
			<td><?php echo $profile['company']; ?></td>
			<td><?php echo $profile['company_city']; ?></td>
			<td><?php echo $profile['trainer_firstname']; ?></td>
			<td><?php echo $profile['trainer_surname']; ?></td>
			<td><?php echo $profile['year_of_apprenticeship']; ?></td>
			<td><?php echo $profile['career_aspiration']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'profiles', 'action' => 'view', $profile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'profiles', 'action' => 'edit', $profile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'profiles', 'action' => 'delete', $profile['id']), null, __('Are you sure you want to delete # %s?', $profile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Catalogs'); ?></h3>
	<?php if (!empty($user['UserCatalog'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Rank'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserCatalog'] as $userCatalog): ?>
		<tr>
			<td><?php echo $userCatalog['user_id']; ?></td>
			<td><?php echo $userCatalog['year']; ?></td>
			<td><?php echo $userCatalog['points']; ?></td>
			<td><?php echo $userCatalog['rank']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_catalogs', 'action' => 'view', $userCatalog['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_catalogs', 'action' => 'edit', $userCatalog['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_catalogs', 'action' => 'delete', $userCatalog['id']), null, __('Are you sure you want to delete # %s?', $userCatalog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Catalog'), array('controller' => 'user_catalogs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Catalogs2011s'); ?></h3>
	<?php if (!empty($user['UserCatalogs2011'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Rank'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserCatalogs2011'] as $userCatalogs2011): ?>
		<tr>
			<td><?php echo $userCatalogs2011['user_id']; ?></td>
			<td><?php echo $userCatalogs2011['year']; ?></td>
			<td><?php echo $userCatalogs2011['points']; ?></td>
			<td><?php echo $userCatalogs2011['rank']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_catalogs2011s', 'action' => 'view', $userCatalogs2011['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_catalogs2011s', 'action' => 'edit', $userCatalogs2011['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_catalogs2011s', 'action' => 'delete', $userCatalogs2011['id']), null, __('Are you sure you want to delete # %s?', $userCatalogs2011['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Catalogs2011'), array('controller' => 'user_catalogs2011s', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Catalogs Olds'); ?></h3>
	<?php if (!empty($user['UserCatalogsOld'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Rank'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserCatalogsOld'] as $userCatalogsOld): ?>
		<tr>
			<td><?php echo $userCatalogsOld['user_id']; ?></td>
			<td><?php echo $userCatalogsOld['year']; ?></td>
			<td><?php echo $userCatalogsOld['points']; ?></td>
			<td><?php echo $userCatalogsOld['rank']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_catalogs_olds', 'action' => 'view', $userCatalogsOld['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_catalogs_olds', 'action' => 'edit', $userCatalogsOld['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_catalogs_olds', 'action' => 'delete', $userCatalogsOld['id']), null, __('Are you sure you want to delete # %s?', $userCatalogsOld['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Catalogs Old'), array('controller' => 'user_catalogs_olds', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Catalogs Tmps'); ?></h3>
	<?php if (!empty($user['UserCatalogsTmp'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Rank'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserCatalogsTmp'] as $userCatalogsTmp): ?>
		<tr>
			<td><?php echo $userCatalogsTmp['user_id']; ?></td>
			<td><?php echo $userCatalogsTmp['year']; ?></td>
			<td><?php echo $userCatalogsTmp['points']; ?></td>
			<td><?php echo $userCatalogsTmp['rank']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_catalogs_tmps', 'action' => 'view', $userCatalogsTmp['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_catalogs_tmps', 'action' => 'edit', $userCatalogsTmp['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_catalogs_tmps', 'action' => 'delete', $userCatalogsTmp['id']), null, __('Are you sure you want to delete # %s?', $userCatalogsTmp['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Catalogs Tmp'), array('controller' => 'user_catalogs_tmps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Points'); ?></h3>
	<?php if (!empty($user['UserPoint'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Finished'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserPoint'] as $userPoint): ?>
		<tr>
			<td><?php echo $userPoint['user_id']; ?></td>
			<td><?php echo $userPoint['points']; ?></td>
			<td><?php echo $userPoint['finished']; ?></td>
			<td><?php echo $userPoint['year']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_points', 'action' => 'view', $userPoint['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_points', 'action' => 'edit', $userPoint['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_points', 'action' => 'delete', $userPoint['id']), null, __('Are you sure you want to delete # %s?', $userPoint['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Point'), array('controller' => 'user_points', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Forms'); ?></h3>
	<?php if (!empty($user['Form'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Online Date'); ?></th>
		<th><?php echo __('File'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Form'] as $form): ?>
		<tr>
			<td><?php echo $form['id']; ?></td>
			<td><?php echo $form['online_date']; ?></td>
			<td><?php echo $form['file']; ?></td>
			<td><?php echo $form['title']; ?></td>
			<td><?php echo $form['year']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forms', 'action' => 'view', $form['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forms', 'action' => 'edit', $form['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forms', 'action' => 'delete', $form['id']), null, __('Are you sure you want to delete # %s?', $form['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($user['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Form Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Question'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('File'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Online Date'); ?></th>
		<th><?php echo __('Offline Date'); ?></th>
		<th><?php echo __('Special Photo'); ?></th>
		<th><?php echo __('Special Name'); ?></th>
		<th><?php echo __('Special Desc'); ?></th>
		<th><?php echo __('Video Before'); ?></th>
		<th><?php echo __('Video After'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['id']; ?></td>
			<td><?php echo $question['form_id']; ?></td>
			<td><?php echo $question['type']; ?></td>
			<td><?php echo $question['points']; ?></td>
			<td><?php echo $question['question']; ?></td>
			<td><?php echo $question['image']; ?></td>
			<td><?php echo $question['file']; ?></td>
			<td><?php echo $question['order']; ?></td>
			<td><?php echo $question['online_date']; ?></td>
			<td><?php echo $question['offline_date']; ?></td>
			<td><?php echo $question['special_photo']; ?></td>
			<td><?php echo $question['special_name']; ?></td>
			<td><?php echo $question['special_desc']; ?></td>
			<td><?php echo $question['video_before']; ?></td>
			<td><?php echo $question['video_after']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
