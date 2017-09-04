<?php
use Application\Form\Generic;
use Application\Form\Element\Radio;
use Application\Form\Element\Select;

require __DIR__ . '/../Application/Autoload/Loader.php';
Application\Autoload\Loader::init(__DIR__ . '/..');

$wrappers = [
    Generic::INPUT => [
        'type' => 'td',
        'class' => 'content'
    ],
    Generic::LABEL => [
        'type' => 'th',
        'class' => 'label'
    ],
    Generic::ERRORS => [
        'type' => 'td',
        'class' => 'error'
    ]
];

$email = new Generic('email', Generic::TYPE_EMAIL, 'Email', $wrappers, [
    'id' => 'email',
    'maxLength' => 128,
    'title' => 'Enter address',
    'required' => ''
]);

$password = new Generic('password', $email);
$password->setType(Generic::TYPE_PASSWORD);
$password->setLabel('Password');
$password->setAttributes([
    'id' => 'password',
    'title' => 'Enter your password',
    'required' => ''
]);

$statusList = [
    'U' => 'Unconfirmed',
    'P' => 'Pending',
    'T' => 'Temporary Approval',
    'A' => 'Approved'
];

$status = new Radio('status', Generic::TYPE_RADIO, 'Status', $wrappers, [
    'id' => 'status'
]);
$checked = $_GET['status'] ?? 'U';
$status->setOptions($statusList, $checked, '<br>', TRUE);

$status1 = new Select('status1', Generic::TYPE_SELECT, 'Status 1', $wrappers, [
    'id' => 'status1'
]);
$status2 = new Select('status2', Generic::TYPE_SELECT, 'Status 2', $wrappers, [
    'id' => 'status2',
    'multiple' => '',
    'size' => '4'
]);
$checked1 = $_GET['status1'] ?? 'U';
$checked2 = $_GET['status2'] ?? ['U', 'T'];
$status1->setOptions($statusList, $checked1);
$status2->setOptions($statusList, $checked2);

$submit = new Generic('submit', Generic::TYPE_SUBMIT, 'Login', $wrappers, [
    'id' => 'submit',
    'title' => 'Click to login',
    'value' => 'Click Here'
]);
?>
<div class="container">
	<!-- Login Form -->
	<h1>Login</h1>
	<form name="login" method="post">
		<table id="login" class="display" cellspacing="0" width="100%">
			<tr><?= $email->render(); ?></tr>
			<tr><?= $password->render(); ?></tr>
			<tr><?= $status->render(); ?></tr>
			<tr><?= $status1->render(); ?></tr>
			<tr><?= $status2->render(); ?></tr>
			<tr><?= $submit->render(); ?></tr>
			<tr>
				<td colspan=2><br>
                	<?php var_dump($_POST); ?>
                </td>
			</tr>
		</table>
	</form>
</div>