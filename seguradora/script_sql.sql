/* INSERÇÃO DE  SISTEMA */
INSERT INTO "public".faderim_system (system_id, system_name, system_description, system_package, system_enable) 
	VALUES ('SEGURADORA', 'Seguradora', 'Seguradora', 'Seguradora', true);
/* INSERÇÃO DE  PAGES */
INSERT INTO "public".faderim_page (page_name, system_id, page_title) 
	VALUES ('seguradora_admin', 'SEGURADORA', 'Painel Administrativo');
INSERT INTO "public".faderim_page (page_name, system_id, page_title) 
	VALUES ('seguradora_login', 'SEGURADORA', 'Login');
/* INSERÇÃO DE ROTAS */
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_admin', 'seguradora_admin', 'Administrador', 'Seguradora::Controller::AdminIndexController.view', '/');
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_login', 'seguradora_login', 'Login', 'Seguradora::Controller::LoginController.view', '/login');
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_usuario_list', 'seguradora_login', 'Consulta de Usuários', 'Seguradora::Controller::Grid::UsuarioGridController.view', NULL);
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_usuario_add', 'seguradora_login', 'Incluir Usuário', 'Seguradora::Controller::Form::UsuarioFormController.add', NULL);
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_usuario_edit', 'seguradora_login', 'Alterar Usuário', 'Seguradora::Controller::Form::UsuarioFormController.edit', NULL);
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_usuario_delete', 'seguradora_login', 'Excluir Usuário', 'Seguradora::Controller::Form::UsuarioFormController.delete', NULL);
INSERT INTO "public".faderim_router (router_name, page_name, router_title, router_controller, router_path) 
	VALUES ('seg_logout', 'seguradora_login', 'Logout', 'Seguradora::Controller::LoginController.logout', '/logout');


