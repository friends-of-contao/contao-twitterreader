
<?php if (!$this->searchable): ?>
<!-- indexer::stop -->
<?php endif; ?>
<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<ul class="<?php echo $this->class; ?>">
	<?php if ($this->TwitterData): ?>
		<?php foreach ($this->TwitterData as $item): ?>
		 
			<li class="<?php echo $item->EvenOdd; ?> <?php echo $item->First; ?> <?php echo $item->Last; ?>">
			<span class="date"><?php echo date($GLOBALS['TL_CONFIG']['dateFormat'],strtotime($item->created_at)); ?></span>
			<?php echo $item->text; ?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>    
</ul>

</div>
<?php if (!$this->searchable): ?>
<!-- indexer::continue -->
<?php endif; ?>


<?php echo $this->myForm; ?>