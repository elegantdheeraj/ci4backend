<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Page navigation') ?>">
	<ul class="pagination">
		<?php if ($pager->hasPrevious()) : ?>
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('First') ?>">
					<span aria-hidden="true"><i class="fa fa-step-backward" aria-hidden="true"></i></span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getPrevious() ?>"  aria-label="<?= lang('Privious') ?>">
					<span aria-hidden="true"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
				</a>
			</li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : ?>
			<li class="page-item <?= $link['active'] ? 'active' : '' ?>">
				<a class="page-link" href="<?= $link['uri'] ?>">
					<?= $link['title'] ?>
				</a>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Next') ?>">
					<span aria-hidden="true"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
				</a>
			</li>
			<li class="page-item">
				<a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('End') ?>">
				<span aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span>
				</a>
			</li>
		<?php endif ?>
	</ul>
</nav>
