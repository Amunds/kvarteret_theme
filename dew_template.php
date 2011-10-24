<?php

remove_all_actions('dew_render_fullevent');
add_action('dew_render_fullevent', 'kvarteret_fullEvent', 10, 2);

remove_all_actions('dew_render_fullfestival');
add_action('dew_render_fullfestival', 'kvarteret_fullFestival', 10, 2);

//remove_all_actions('kvarteret_event_detailbox');
add_action('kvarteret_event_detailbox', 'kvarteret_event_detailbox', 10, 1);
add_action('kvarteret_festival_detailbox', 'kvarteret_festival_detailbox', 10, 1);

	function kvarteret_fullEvent($rawEvent, array $config = array()) {
		// All named arguments are required in the format

		/**
		 * $config can be an associative array
		 * array(
		 * 	'no_title' => bool, // Whether to include the title or not
		 * 	'exclude_metadata' => bool, // Whether to include the metadata (start/end, location, etc) or not
		 * )
		 */

		$event = new DEW_event($rawEvent);

		$googleCalUrl = DEW_tools::createGoogleCalUrl($rawEvent);

		$title = '<h2>' . $event->getTitle() . '</h2>';
		if (isset($config['no_title']) && ($config['no_title'] == true)) {
			$title = '';
		}

		?>
<div class="agenda_event_wrapper">

  <p><?php echo $event->getLeadParagraph() ?></p>
  <?php echo $event->getDescription() ?>

  <?php if ($event->hasPrimaryPicture()): ?>
  <img src="<?php echo DEW_tools::getPictureUrl($event->getPrimaryPicture()) ?>" alt="<?php echo $event->getPrimaryPicture()->description ?>" />
  <?php endif ?>

  <p><small><a href="<?php echo $event->getUrl(false) ?>"><?php _e('Orginal event', 'dak_events_wp') ?></a></small></p>
</div>
		<?php

	}

function kvarteret_event_detailbox ($rawEvent) {
	$event = new DEW_event($rawEvent);

	$startTime = date('H:i', $event->getStartTimestamp());

	$duration = $event->getFormattedDuration();

	$googleCalUrl = DEW_tools::createGoogleCalUrl($rawEvent);
	?>

<div class="kvarteret_event_wrapper">

	<?php if ($event->hasFestival()): ?>
    <span><?php _e('Part of festival', 'dak_events_wp') ?></span>
    <a href="<?php echo $event->getFestivalUrl() ?>" class="festival_link"><?php echo $event->getFestivalTitle() ?></a>
    <p>(<?php echo date('d.m.Y', $event->getFestivalStartTimestamp()) ?> - <?php echo date('d.m.Y', $event->getFestivalEndTimestamp()) ?>)</p>
	<?php endif ?>

    <?php printf(__('%s in %s', 'dak_events_wp') , $event->getCategory(), $event->getLocation()) ?><br />
    <?php echo __('Starts:', 'dak_events_wp') . ' ' . $duration ?><br />
    <?php echo __('Arranger:', 'dak_events_wp') . ' ' . $event->getArranger() ?><br />

	<?php if ($event->hasCoverCharge()): ?>
	<br />
    <h2><?php _e('Covercharge', 'dak_events_wp') ?></h2>
	<?php echo $event->getCoverCharge()  ?><br />
	<?php endif ?>

	<br />
	<h2><?php _e('Calendar', 'dak_events_wp') ?></h2>

    <a href="<?php echo $event->getICalUrl() ?>">
      <?php _e('Add to calendar (iCal)', 'dak_events_wp') ?>
    </a><br />

    <a href="<?php echo $googleCalUrl ?>" target="_blank">
      <?php _e('Add to Google calendar', 'dak_events_wp') ?>
    </a>
</div>

	<?php
}

function kvarteret_fullFestival($rawFestival, $dateSortedEvents, array $config = array()) {
		// All named arguments are required in the format

		/**
		 * $config can be an associative array
		 * array(
		 * 	'no_title' => bool, // Whether to include the title or not
		 * 	'exclude_metadata' => bool, // Whether to include the metadata (start/end, location, etc) or not
		 * )
		 */

		$festival = new DEW_festival($rawFestival);

		$googleCalUrl = DEW_tools::createGoogleCalUrl($rawFestival);

		?>
<div class="agenda_event_wrapper">

  <p><?php echo $festival->getLeadParagraph() ?></p>
  <?php echo $festival->getDescription() ?>

  <div id='dew_festivalEvents'>
   <?php do_action('dew_render_agenda', $dateSortedEvents) ?>
  </div>

  <p><small><a href="<?php echo $festival->getUrl(false) ?>"><?php _e('Orginal festival', 'dak_events_wp') ?></a></small></p>
</div>

		<?php
	}

function kvarteret_festival_detailbox ($rawFestival) {
	$festival = new DEW_festival($rawFestival);

	$startTime = date('H:i', $festival->getStartTimestamp());

	$duration = $festival->getFormattedDuration();

	$googleCalUrl = DEW_tools::createGoogleCalUrl($rawFestival);
	?>

<div class="kvarteret_festival_wrapper">

    <?php echo __('Where:', 'dak_events_wp') . ' ' . $festival->getLocation() ?><br />
    <?php echo __('Starts:', 'dak_events_wp') . ' ' . $duration ?><br />
    <?php echo __('Arranger:', 'dak_events_wp') . ' ' . $festival->getArranger() ?>

	<?php if ($festival->hasCoverCharge()): ?>
	<br />
    <h2><?php _e('Covercharge', 'dak_events_wp') ?></h2>
	<?php echo $event->getCoverCharge()  ?><br />
	<?php endif ?>

	<br />
	<h2><?php _e('Calendar', 'dak_events_wp') ?></h2>

    <a href="<?php echo $festival->getICalUrl() ?>">
      <?php _e('Add to calendar (iCal)', 'dak_events_wp') ?>
    </a><br />

    <a href="<?php echo $googleCalUrl ?>" target="_blank">
      <?php _e('Add to Google calendar', 'dak_events_wp') ?>
    </a>
</div>

	<?php
}
