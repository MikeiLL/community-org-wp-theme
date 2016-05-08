<?php
/**
 * Template Name: Home Template
 */
?>

<?php // while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php //get_template_part('templates/content', 'page'); ?>

  <!-- row for wells -->
		<div class="content-grid mdl-grid mdl-grid--no-spacing mdl-color--blue-100">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-grid">
          <div class="mdl-card mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet mdl-shadow--6dp">
            <div class="mdl-card__title">
              <h1 class="mdl-card__title-text">Nursing Home Abuse</h1>
            </div>
            <div class="mdl-card__supporting-text">
              <p>Elder neglect, or nursing home negligence, most commonly occurs when a resident does not receive proper medical, physical, or emotional attention. As a result, neglect can pose serious risk of harm to victims. In certain cases, neglect may escalate to physical or emotional abuse.</p>
              <button class="mdl-button mdl-button--raised mdl-button--accent">I can help</button>
              <button id="lang-switcher" class="mdl-button mdl-js-button mdl-button--icon">
    <i class="material-icons">language</i>
</button>
<ul class="mdl-menu mdl-js-menu mdl-menu--top-right" for="lang-switcher">
    <li class="mdl-menu__item">English</li>
    <li class="mdl-menu__item">日本語</li>
    <li class="mdl-menu__item">한국어</li>
</ul>
            </div>
          </div>
        </div>
      </div>
    </div>

	<div class="content-grid mdl-grid" style="height:300px">
      <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-color--yellow-500">
        One
      </div>
      <div class="mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-color--green-100">
        Two
      </div>
      <div class="mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-color--red-100">
        Three
      </div>
  </div>

  	<div class="content-grid mdl-grid" style="height:300px">
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-50">
        50
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-100">
        100
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-200">
        200
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-300">
        300
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-400">
        400
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-500">
        500
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-600">
        600
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-700">
        700
      </div><div class="mdl-cell mdl-cell--1-col mdl-color--yellow-A100">
        A100
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-A200">
        A200
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-A400">
        A400
      </div>
      <div class="mdl-cell mdl-cell--1-col mdl-color--yellow-A700">
        A700
      </div>
  </div>

<div class="content-grid mdl-grid" style="height:300px">
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-50">
      50
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-100">
      100
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-200">
      200
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-300">
      300
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-400">
      400
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-500">
      500
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-600">
      600
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-700">
      700
    </div><div class="mdl-cell mdl-cell--1-col mdl-color--grey-A100">
      A100
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-A200">
      A200
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-A400">
      A400
    </div>
    <div class="mdl-cell mdl-cell--1-col mdl-color--grey-A700">
      A700
    </div>
</div>

<?php // endwhile; ?>
