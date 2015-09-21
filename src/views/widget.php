<?php

use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $id string */
/** @var $services stdClass[] See EAuth::getServices() */
/** @var $action string */
/** @var $popup bool */
/** @var $assetBundle string Alias to AssetBundle */

Yii::createObject(array('class' => $assetBundle))->register($this);

// Open the authorization dilalog in popup window.
if ($popup) {
	$options = array();
	foreach ($services as $name => $service) {
		$options[$service->id] = $service->jsArguments;
	}
	$this->registerJs('$("#' . $id . '").eauth(' . json_encode($options) . ');');
}

?>
<div class="eauth" id="<?php echo $id; ?>">
	<ul class="eauth-list">
		<?php
		foreach ($services as $name => $service) {
			echo '<li class="eauth-service eauth-service-id-' . $service->id . '">';
			/*echo Html::a($service->title, array($action, 'service' => $name), array(
				'class' => 'eauth-service-link',
				'data-eauth-service' => $service->id,
			)); */
			if($service->id == 'google_oauth'){ $service->id = 'google-plus'; $service->title = 'Google plus'; }
			echo "<a class='eauth-service-link' href=\"/profile/default/login?service=$name\" data-eauth-service='$name'>";
			echo '<span class="icon-' . $service->id . '"></span>';
			echo "Login with " .  $service->title . "</a>";
			echo '</li>';
		}
		?>
	</ul>
</div>
