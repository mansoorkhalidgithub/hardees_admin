<?php
return [
	'STATUS_REJECT' => "TRRD",
	'STATUS_ACCEPT' => 'TRA',
	'STATUS_ARRIVED' => 'TRDA',
	'STATUS_PICKUP' => 'TRDA',
	'STATUS_START_DELIVERY' => 'TS',
	'STATUS_COMPLETE_DELIVERY' => 'TC',
	'STATUS_CASH_COLLECTED' => 'TPDD',
	'STATUS_REVIEW' => 'TCRD',
	'STATUS_REJECTED_AFTER_ACCEPT' => 'TRRDAA',

	'STATUS_ACTIVE' => 1,
	'STATUS_INACTIVE' => 0,
	'STATUS_OFFLINE' => 9,
	'STATUS_ONLINE' => 10,

	'order_pending' => 1,
	'order_accepted' => 2,
	'order_preparing' => 3,
	'order_ready' => 4,
	'order_outForDelivery' => 5,
	'order_completed' => 6,
	'order_rejected' => 7,
];
