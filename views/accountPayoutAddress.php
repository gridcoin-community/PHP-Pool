<?php

$webPage->addBreadcrumb('account','user','/account');

$webPage->setPageTitle('Payout Settings');
$panel = new Bootstrap_Panel();
$panel->setContext('success');
$panel->setHeader(''.Constants::CURRENCY_ABBREV.' Payout Address');
if ($this->view->clientOn == '1') {
	$form = new Bootstrap_Form();
	$form->setAction('/account/payoutAddress');
	
	$input = new Bootstrap_TextInput();
	$input->setLabel(''.Constants::CURRENCY_ABBREV.' Address');
	$input->setId('grcAddress');
	$input->setDefault($this->view->grcAddress);
	$form->addField($input);
	
	$input = new Bootstrap_TextInput();
	$input->setLabel($this->view->twoFactor?'Two Factor Token':'Password');
	$input->setPassword(!$this->view->twoFactor);
	$input->setId('password');
	$form->addField($input);
	
	$form->setButtons('
		<input type="hidden" name="cmd" value="grcAddress"/>
		<button id="" class="btn btn-primary type="submit">set address</button>	
	');
	
	$panel->setContent('
		<div class="rowpad">
			In order to receive '.Constants::CURRENCY_ABBREV.' for your research, you need to have a '.Constants::CURRENCY_ABBREV.' address. You can find your address in the '.Constants::CURRENCY_ABBREV.' client and selecting &quot;Receive Coins&quot;.
			You will need to authorize this change with your password or two factor authentication token. An email will be sent to the email address on file when the address is changed.
		</div>
		'.$form->render().'
	');

} else {
	$panel->setContent('The '.Constants::CURRENCY_ABBREV.' hot wallet is currently offline. The client is used to verify '.Constants::CURRENCY_ABBREV.' addresses. Please return when the client is online. You may want to follow the facebook page to monitor progress.');
}
$webPage->append($panel->render());

////////////////////////////////////////////////

$panel = new Bootstrap_Panel();
$panel->setHeader('Minimum Payout Amount');
$panel->setContext('warning');
$form = new Bootstrap_Form();
$form->setAction('/account/payoutAddress');
$input = new Bootstrap_TextInput();
$input->setLabel('Minimum Payout Amount');
$input->setId('minimumAmount');
$input->setDefault($this->view->minAmount);
$input->setHelp('range 1 - 1000, integers only');
$form->addField($input);
$form->setButtons('
	<input type="hidden" name="cmd" value="minAmount"/>
	<button id="" class="btn btn-primary type="submit">set minimum amount</button>
');
$panel->setContent('
	<div class="rowpad">
		Customize what the minimum amount owed needs to be for your payment.
	</div>
	'.$form->render()
);
$webPage->append('<a name="minpayout"></a>'.$panel->render());

////////////////////////////////////////////////

$panel = new Bootstrap_Panel();
$panel->setHeader('Donation Amount');
$panel->setContext('info');
$form = new Bootstrap_Form();
$form->setAction('/account/payoutAddress');
$input = new Bootstrap_TextInput();
$input->setLabel('Donation Amount');
$input->setId('donation');
$input->setDefault($this->view->donation);
$input->setButtonAddon('%');
$input->setHelp('valid range: 0.01-100.00');
$form->addField($input);
$form->setButtons('
	<input type="hidden" name="cmd" value="donation"/>
	<button id="" class="btn btn-primary type="submit">set donation amount</button>
');
$panel->setContent('
		<div class="rowpad">
			If you feel like giving a little back to support the pool\'s efforts, you can give as little as .01%. 
			See how you compare to the <a href="/report/earnDonation">pool\'s top donators</a>.
			You can also see how much '.Constants::CURRENCY_ABBREV.' the pool is making on the <a href="/report/poolBalance">financial report</a>.</div>
	'.
	$form->render()
);
$webPage->append('<a name="donation"></a>'.$panel->render());

