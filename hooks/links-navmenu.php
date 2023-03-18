<?php
		/*
	 * You can add custom links in the home page by appending them here ...
	 * The format for each link is:
		$navLinks[] = array(
			'url' => 'path/to/link', 
			'title' => 'Link title', 
			'description' => 'Link text',
			'groups' => array('group1', 'group2'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			'panel_classes' => '', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			'link_classes' => '', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			'icon' => 'path/to/icon' // optional icon to use with the link
		);
	 */

	/* http://localhost/demo/orders_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=&FilterField%5B1%5D=6&FilterOperator%5B1%5D=is-empty&FilterValue%5B1%5D= */
	
		$navLinks[] = array(
			'url' => 'pqr_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=43&FilterOperator%5B1%5D=not-equal-to&FilterValue%5B1%5D=CERRADA', 
			'title' => 'PQRs ABIERTAS', 
			'description' => 'PQR Abiertas y en gestion',
			'groups' => array('Admins','Auxiliares','SSM'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'table_group' => ('PQR'),
			'grid_column_classes' => 'col-md-4 col-lg-4', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			'panel_classes' => 'panel-danger', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			'link_classes' => 'btn-danger', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			'icon' => 'resources/table_icons/nameboard_open.png' // optional icon to use with the link
		);
		
		// $navLinks[] = array(
			// 'url' => 'pqr_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=47&FilterOperator%5B1%5D=is-empty&FilterValue%5B1%5D=&FilterAnd%5B2%5D=and&FilterField%5B2%5D=51&FilterOperator%5B2%5D=equal-to&FilterValue%5B2%5D=1', 
			// 'title' => 'PQRs POR VERIFICAR', 
			// 'description' => 'PQR Abiertas y en gestion',
			// 'table_group' => ('PQR'),
			// 'groups' => array('Admins','Auxiliares'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => '', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => '', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/document_prepare.png' // optional icon to use with the link
		// );

			$navLinks[] = array(
			'url' => 'pqr_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=43&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D=CERRADA', 
			'title' => 'PQRs FINALIZADAS',
			'description' => 'PQR Gestionadas',
			'groups' => array('*'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'table_group' => ('PQR'),
			'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			'panel_classes' => 'panel-success', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			'link_classes' => 'btn-success', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			'icon' => 'resources/table_icons/check_box.png' // optional icon to use with the link
		);
		

		// $navLinks[] = array(
			// 'url' => 'pqr_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=47&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D=No+Contactado', 
			// 'title' => 'PQRs NO PROCESADAS', 
			// 'description' => 'PQR que por motivos externos a la entidad no pudieron gestionarse',
			// 'groups' => array('Admins','Auxiliares'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'table_group' => ('PQR'),
			// 'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => '', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => '', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/group_error.png' // optional icon to use with the link
		// );
		
		
			// $navLinks[] = array(
			// 'url' => 'pqr_view.php', 
			// 'title' => 'PQRs TOTALES', 
			// 'description' => 'Totalidad de PQR radicadas hasta la fecha en cada uno de sus estados y condiciones.',
			// 'table_group' => ('PQR'),
			// 'groups' => array('Admins'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => 'panel-warning', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => 'btn-warning', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/user_comment.png' // optional icon to use with the link
		// );
			
			$navLinks[] = array(
			'url' => 'https://ozzyta-dashboardrozzys-main-app-4be10d.streamlit.app/" target="_blank',
			'title' => 'DASHBOARD', 
			'description' => 'Informe Grafico de las PQR',
			'groups' => array('*'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'table_group' => ('PQR'),
			'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			'panel_classes' => '', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			'link_classes' => '', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			'icon' => 'resources/table_icons/chart_pie_alternative.png' // optional icon to use with the link
		);


			// $navLinks[] = array(
			// 'url' => 'covid_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=28&FilterOperator%5B1%5D=is-empty&FilterValue%5B1%5D=',
			// 'title' => 'ENCUESTAS DE CUMPLIMIENTO PENDIENTES', 
			// 'description' => 'ENCUESTAS PENDIENTES',
			// 'groups' => array('Admins','Auxiliares'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'table_group' => ('Aislamiento Preventivo Obligatorio'),
			// 'grid_column_classes' => 'col-md-1 col-lg-6', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => '', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => '', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/participation_rate.png' // optional icon to use with the link
		// );
		
		// $navLinks[] = array(
			// 'url' => 'covid_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=28&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D=Encuestado',
			// 'title' => 'ENCUESTAS DE CUMPLIMIENTO REALIZADAS', 
			// 'description' => 'ENCUESTAS REALIZADAS',
			// 'groups' => array('Admins','Auxiliares'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'table_group' => ('Aislamiento Preventivo Obligatorio'),
			// 'grid_column_classes' => 'col-md-1 col-lg-6', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => 'panel-success', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => 'btn-success', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/tick.png' // optional icon to use with the link
		// );

		// $navLinks[] = array(
			// 'url' => 'covid_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=28&FilterOperator%5B1%5D=equal-to&FilterValue%5B1%5D=No+Encuestado',
			// 'title' => 'ENCUESTAS DE CUMPLIMIENTO NO LOGRADAS', 
			// 'description' => 'ENCUESTAS QUE POR MOTIVOS EXTERNOS A LA ENTIDAD NO LOGRARON COMPLETARSE',
			// 'groups' => array('Admins','Auxiliares'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'table_group' => ('Aislamiento Preventivo Obligatorio'),
			// 'grid_column_classes' => 'col-md-1 col-lg-6', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => 'panel-danger', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => 'btn-danger', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/exclamation.png' // optional icon to use with the link
		// );
		
		// $navLinks[] = array(
			// 'url' => 'covid_view.php',
			// 'title' => 'ENCUESTAS DE CUMPLIMIENTO TOTALES', 
			// 'description' => 'ENCUESTAS QUE POR MOTIVOS EXTERNOS A LA ENTIDAD NO LOGRARON COMPLETARSE',
			// 'groups' => array('Admins'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			// 'table_group' => ('Aislamiento Preventivo Obligatorio'),
			// 'grid_column_classes' => 'col-md-1 col-lg-6', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			// 'panel_classes' => 'panel-warning', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			// 'link_classes' => 'btn-warning', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
			// 'icon' => 'resources/table_icons/health.png' // optional icon to use with the link
			//'col-xs-12 col-sm-6 col-md-6 col-lg-6',
		// );
		

// /* $navLinks[] = array(
		// 'url' => 'hooks/summary-reports-list.php',
		// 'title' => 'Summary Reports',
		// 'groups' => array('Parametros'),
		// 'icon' => 'hooks/summary_reports-logo-md.png'
	// );
	
		$navLinks[] = array(
			'url' => 'https://lookerstudio.google.com/reporting/1054b5e0-7f04-4e24-8a01-a7c544120ab5" target="_blank',
			'title' => 'Informes PQR x Periodo - MC',
			'groups' => array('Admins','Auxiliares'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'icon' => 'resources/table_icons/chart_pie_alternative.png',
			'table_group' => 3, // optional index of table group, default is 0
		);
		
		$navLinks[] = array(
			'url' => 'https://datastudio.google.com/u/0/reporting/8431a726-55c7-4e7b-96ec-53f2ee9c920b" target="_blank',
			'title' => 'Informes Otros Tramites',
			'groups' => array('Admins','SSM'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'icon' => 'https://icons8.com/icon/80255/bar-chart',
			'table_group' => 3, // optional index of table group, default is 0
		);


		$navLinks[] = array(
			'url' => 'manualRozzyS.pdf" target="_blank',
			'title' => 'Manual de Usuarios',
			'groups' => array('Admins','Auxiliares','SSM'), // groups allowed to see this link, use '*' if you want to show the link to all groups
			'icon' => 'resources/table_icons/tick.png',
			'table_group' => 3,
			'grid_column_classes' => '', // optional CSS classes to apply to link block. See: http://getbootstrap.com/css/#grid
			'panel_classes' => '', // optional CSS classes to apply to panel. See: http://getbootstrap.com/components/#panels
			'link_classes' => '', // optional CSS classes to apply to link. See: http://getbootstrap.com/css/#buttons
		);

