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
/* usuário de desenvolvimento */
INSERT INTO "public".usuario (usu_id, usu_nome, usu_senha, usu_login) 
	VALUES (1, 'Administrador', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'seguradora@admin.com.br');

insert into faderim_page (page_name, system_id, page_title) values ('seguradora_tipo_pergunta','SEGURADORA','Tipo de Pergunta');
insert into faderim_page (page_name, system_id, page_title) values ('seguradora_tipo_seguro','SEGURADORA','Tipo de Seguro');
insert into faderim_page (page_name, system_id, page_title) values ('seguradora_pergunta','SEGURADORA','Pergunta');

insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_pergunta_list','seguradora_tipo_pergunta','Consulta de Tipos de Perguntas','Seguradora::Controller::Grid::TipoPerguntaGridController.view', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_pergunta_add','seguradora_tipo_pergunta','Incluir Tipo de Perguna','Seguradora::Controller::Form::TipoPerguntaFormController.add', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_pergunta_edit','seguradora_tipo_pergunta','Alterar Tipo de Perguna','Seguradora::Controller::Form::TipoPerguntaFormController.edit', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_pergunta_delete','seguradora_tipo_pergunta','Excluir Tipo de Perguna','Seguradora::Controller::Form::TipoPerguntaFormController.delete', null);

insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_seguro_list','seguradora_tipo_seguro','Consulta de Tipos de Seguros','Seguradora::Controller::Grid::TipoSeguroGridController.view', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_seguro_add','seguradora_tipo_seguro','Incluir Tipo de Seguro','Seguradora::Controller::Form::TipoSeguroFormController.add', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_seguro_edit','seguradora_tipo_seguro','Alterar Tipo de Seguro','Seguradora::Controller::Form::TipoSeguroFormController.edit', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_tipo_seguro_delete','seguradora_tipo_seguro','Excluir Tipo de Seguro','Seguradora::Controller::Form::TipoSeguroFormController.delete', null);

insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_pergunta_list','seguradora_pergunta','Consulta de Perguntas','Seguradora::Controller::Grid::PerguntaGridController.view', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_pergunta_add','seguradora_pergunta','Incluir Perguna','Seguradora::Controller::Form::PerguntaFormController.add', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_pergunta_edit','seguradora_pergunta','Alterar Perguna','Seguradora::Controller::Form::PerguntaFormController.edit', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_pergunta_delete','seguradora_pergunta','Excluir Perguna','Seguradora::Controller::Form::PerguntaFormController.delete', null);


/* CLIENTE */
insert into faderim_page (page_name, system_id, page_title) values ('seguradora_cliente','SEGURADORA','Cliente');

insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_cliente_list','seguradora_cliente','Consultar Cliente','Seguradora::Controller::Grid::ClienteGridController.view', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_cliente_add','seguradora_cliente','Incluir Cliente','Seguradora::Controller::Form::ClienteFormController.add', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_cliente_edit','seguradora_cliente','Alterar Cliente','Seguradora::Controller::Form::ClienteFormController.edit', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_cliente_delete','seguradora_cliente','Excluir Cliente','Seguradora::Controller::Form::ClienteFormController.delete', null);


/* APOLICES */
insert into faderim_page (page_name, system_id, page_title) values ('seguradora_apolice','SEGURADORA','Proposta de Apólice');

insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_apolice_list','seguradora_apolice','Consultar Apólices','Seguradora::Controller::Grid::ApoliceGridController.view', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_apolice_add','seguradora_apolice','Incluir Apólice','Seguradora::Controller::Form::ApoliceFormController.add', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_apolice_edit','seguradora_apolice','Alterar Apólice','Seguradora::Controller::Form::ApoliceFormController.edit', null);
insert into faderim_router (router_name, page_name, router_title, router_controller, router_path) values ('seg_apolice_delete','seguradora_apolice','Excluir Apólice','Seguradora::Controller::Form::ApoliceFormController.delete', null);
