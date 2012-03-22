<?php

remove_all_actions('dew_render_fullevent');
add_action('dew_render_fullevent', 'kvarteret_fullEvent', 10, 2);

remove_all_actions('dew_render_fullfestival');
add_action('dew_render_fullfestival', 'kvarteret_fullFestival', 10, 2);

//remove_all_actions('kvarteret_event_detailbox');
add_action('kvarteret_event_detailbox', 'kvarteret_event_detailbox', 10, 2);
add_action('kvarteret_festival_detailbox', 'kvarteret_festival_detailbox', 10, 2);

remove_all_actions('dew_render_widget_list');
add_action('dew_render_widget_list', 'kvarteret_widgetList', 10, 2);

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

function kvarteret_event_detailbox ($rawEvent, eventsCalendarClient $client = null) {
	$event = new DEW_event($rawEvent);

	$startTime = date('H:i', $event->getStartTimestamp());

	$duration = $event->getFormattedDuration();

	$googleCalUrl = DEW_tools::createGoogleCalUrl($rawEvent);

	$arranger = null;

	if (!is_null($client)) {
		$arranger = $client->arranger($rawEvent->arranger_id)->data[0];
	}
	?>

<div class="kvarteret_event_wrapper">

	<?php if (isset($arranger->logo->id)): ?>
	<img src="<?php echo DEW_tools::getPictureUrl($arranger->logo, 200, 300) ?>" alt="<?php echo $arranger->logo->description ?>" class="arranger_logo" />
	<?php endif ?>

	<?php if ($event->hasFestival()): ?>
    <span><?php _e('Part of festival', 'dak_events_wp') ?></span>
    <a href="<?php echo $event->getFestivalUrl() ?>" class="festival_link"><?php echo $event->getFestivalTitle() ?></a>
    <p>(<?php echo date('d.m.Y', $event->getFestivalStartTimestamp()) ?> - <?php echo date('d.m.Y', $event->getFestivalEndTimestamp()) ?>)</p>
	<?php endif ?>

    <?php printf(__('%s in %s', 'dak_events_wp') , $event->getCategory(), $event->getLocation()) ?><br />
    <?php echo __('Starts:', 'dak_events_wp') . ' ' . $duration ?><br />
    <?php echo __('Arranger:', 'dak_events_wp') . ' ' . $event->getArranger() ?>

	<?php if ($event->hasCoverCharge()): ?>
	
    <h2><?php _e('Covercharge', 'dak_events_wp') ?></h2>
	<?php echo $event->getCoverCharge()  ?><br />
	<?php endif ?>

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

function kvarteret_festival_detailbox ($rawFestival, $options = array()) {
	$festival = new DEW_festival($rawFestival);

	$startTime = date('H:i', $festival->getStartTimestamp());

	$duration = $festival->getFormattedDuration();

	$googleCalUrl = DEW_tools::createGoogleCalUrl($rawFestival);
	?>

<div class="kvarteret_festival_wrapper">

    <h2><?php _e('Details', 'dak_events_wp') ?></h2>
    <?php echo __('Where:', 'dak_events_wp') . ' ' . $festival->getLocation() ?><br />
    <?php echo __('Starts:', 'dak_events_wp') . ' ' . $duration ?><br />
    <?php echo __('Arranger:', 'dak_events_wp') . ' ' . $festival->getArranger() ?>

	<?php if ($festival->hasCoverCharge()): ?>
    <h2><?php _e('Covercharge', 'dak_events_wp') ?></h2>
	<?php echo $festival->getCoverCharge()  ?><br />
	<?php endif ?>

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

function kvarteret_widgetList ($dateSortedEvents, $config) {
		?>
<ul class="dew_eventList" id="<?php echo $config['id_base'] ?>-dak-events-wp-list">

<?php

		foreach ($dateSortedEvents as $timestamp => $rawEvents) {
			$dayName = ucfirst(date_i18n('l', $timestamp ));

			if (date('Ymd', $timestamp) == date('Ymd')) {
				echo '<li class="dew_eventList_date">I dag</li>' . "\n";
			} else if (date('Ymd', $timestamp) == date('Ymd', time() + 86400)) {
				echo '<li class="dew_eventList_date">I morgen</li>' . "\n";
			} else {
				$date = date($config['dateFormat'], $timestamp);

				echo '<li class="dew_eventList_date">' . $dayName . ' ' . $date . '</li>' . "\n";
			}

			foreach ($rawEvents as $rawEvent) {
				echo '<li class="dew_event" id="' . $config['id_base'] . '-dak-events-wp-list-' . $rawEvent->id . '">';

				do_action('dew_render_widget_event', $rawEvent);

				echo'</li>' . "\n";
			}
		}

?>

</ul>
		<?php
}
