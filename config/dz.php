<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

	'name' => env('APP_NAME', 'Aplikasi PTPP'),


	'public' => [
		'favicon' => 'media/img/logo/favicon.ico',
		'fonts' => [
			'google' => [
				'families' => [
					'Poppins:300,400,500,600,700',
				]
			]
		],
		'global' => [
			'css' => [
				'templateadmin/vendor/jquery-nice-select/css/nice-select.css',
				'templateadmin/css/style.css',
				'css/custom-ckeditor.css',
			],
			'js' => [
				'top' => [
					'templateadmin/vendor/global/global.min.js',
					'templateadmin/vendor/jquery-nice-select/js/jquery.nice-select.min.js',
				],
				'bottom' => [
					'templateadmin/js/custom.js',
					'templateadmin/js/dlabnav-init.js',
				],
			],
		],
		'pagelevel' => [
			'css' => [
				'AuthenticatedSessionController_create' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'ManagementUsersController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],

				'ManagementUsersController_create' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],

				'ManagementUsersController_edit' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'PengaturanController_index' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],


				'DailyWorkController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'DailyWorkController_create' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],


				'DailyWorkItemController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'DailyWorkItemController_create' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'DailyWorkItemController_edit' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'DisplayController_display' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'CompanyController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'CompanyController_create' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'CompanyController_edit' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],

				'ContractController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'ContractController_create' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'ContractController_edit' => [
					'templateadmin/vendor/select2/css/select2.min.css',
				],











				'PermohonanPtppController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'DashboardController_permohonanPtpp' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'PermohonanPtppController_create' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'PermohonanPtppController_edit' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
					'templateadmin/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'DashboardController_notaPermintaan' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'NotaPermintaanController_index' => [
					'templateadmin/vendor/datatables/css/jquery.dataTables.min.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/select2/css/select2.min.css',
				],
				'NotaPermintaanController_create' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
					'templateadmin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
				],
				'NotaPermintaanController_edit' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.css',
					'templateadmin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
					'templateadmin/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
					'templateadmin/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
				]
			],
			'js' => [
				'AuthenticatedSessionController_create' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],
				'ManagementUsersController_index' => [
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],

				'ManagementUsersController_create' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'ManagementUsersController_edit' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'PengaturanController_index' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],

				'DailyWorkController_index' => [
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],
				'DailyWorkController_create' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],


				'DailyWorkItemController_index' => [
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],
				'DailyWorkItemController_create' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'DailyWorkItemController_edit' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'DisplayController_display' => [
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],

				'CompanyController_index' => [
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],
				'CompanyController_create' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'CompanyController_edit' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'ContractController_index' => [
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
				],
				'ContractController_create' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'ContractController_edit' => [
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],



				'PermohonanPtppController_index' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
					'templateadmin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.js',
					'templateadmin/js/plugins-init/bs-daterange-picker-init.js',
				],
				'DashboardController_permohonanPtpp' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.js',
					'templateadmin/js/plugins-init/bs-daterange-picker-init.js',
				],
				'PermohonanPtppController_create' => [
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'templateadmin/js/plugins-init/material-date-picker-init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/vendor/ckeditor/ckeditor.js',
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'PermohonanPtppController_edit' => [
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'templateadmin/js/plugins-init/material-date-picker-init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/vendor/jquery-steps/build/jquery.steps.min.js',
					'templateadmin/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
					'templateadmin/vendor/ckeditor/ckeditor.js',
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
				],
				'DashboardController_notaPermintaan' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.js',
					'templateadmin/js/plugins-init/bs-daterange-picker-init.js',
				],
				'NotaPermintaanController_index' => [
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/js/plugins-init/datatables.init.js',
					'templateadmin/vendor/select2/js/select2.full.min.js',
					'templateadmin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/js/plugins-init/select2-init.js',
					'templateadmin/vendor/datatables/js/jquery.dataTables.min.js',
					'templateadmin/vendor/bootstrap-daterangepicker/daterangepicker.js',
					'templateadmin/js/plugins-init/bs-daterange-picker-init.js',
				],
				'NotaPermintaanController_create' => [
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'templateadmin/js/plugins-init/material-date-picker-init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'templateadmin/js/plugins-init/material-date-picker-init.js',
					'templateadmin/vendor/ckeditor/ckeditor.js',
				],
				'NotaPermintaanController_edit' => [
					'templateadmin/vendor/moment/moment.min.js',
					'templateadmin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'templateadmin/js/plugins-init/material-date-picker-init.js',
					'templateadmin/vendor/sweetalert2/dist/sweetalert2.min.js',
					'templateadmin/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'templateadmin/js/plugins-init/material-date-picker-init.js',
					'templateadmin/vendor/jquery-steps/build/jquery.steps.min.js',
					'templateadmin/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
					'templateadmin/vendor/ckeditor/ckeditor.js',
				],
			]
		],
	]
];
