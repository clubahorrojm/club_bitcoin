--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.14
-- Dumped by pg_dump version 9.3.14
-- Started on 2017-08-16 21:17:49

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 1 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2140 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 171 (class 1259 OID 28246)
-- Name: adm_asignacion_montos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE adm_asignacion_montos (
    id integer NOT NULL,
    codigo integer,
    porcentaje1 double precision,
    porcentaje2 double precision,
    porcentaje3 double precision,
    porcentaje4 double precision,
    porcentaje5 double precision,
    porcentaje6 double precision,
    porcentaje7 double precision,
    porcentaje8 double precision
);


--
-- TOC entry 172 (class 1259 OID 28249)
-- Name: adm_asignacion_montos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE adm_asignacion_montos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2141 (class 0 OID 0)
-- Dependencies: 172
-- Name: adm_asignacion_montos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE adm_asignacion_montos_id_seq OWNED BY adm_asignacion_montos.id;


--
-- TOC entry 173 (class 1259 OID 28251)
-- Name: adm_claves_sistema; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE adm_claves_sistema (
    id integer NOT NULL,
    clave character varying(128),
    fecha character varying(10),
    hora character varying(12),
    user_create integer
);


--
-- TOC entry 181 (class 1259 OID 28285)
-- Name: adm_comision_retiro; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE adm_comision_retiro (
    id integer NOT NULL,
    codigo integer,
    porcentaje_comision double precision,
    fecha_create character varying(50),
    fecha_update character varying(50),
    user_create character varying(50),
    user_update character varying(50)
);


--
-- TOC entry 174 (class 1259 OID 28254)
-- Name: adm_cuentas_bot; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE adm_cuentas_bot (
    id integer NOT NULL,
    moneda integer,
    monto_pago double precision,
    monto_retiro_minimo double precision,
    fecha character varying(20),
    user_create integer,
    cargo_mora double precision
);


--
-- TOC entry 2142 (class 0 OID 0)
-- Dependencies: 174
-- Name: COLUMN adm_cuentas_bot.cargo_mora; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN adm_cuentas_bot.cargo_mora IS '				';


--
-- TOC entry 175 (class 1259 OID 28257)
-- Name: adm_cuentas_bot_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE adm_cuentas_bot_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2143 (class 0 OID 0)
-- Dependencies: 175
-- Name: adm_cuentas_bot_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE adm_cuentas_bot_id_seq OWNED BY adm_cuentas_bot.id;


--
-- TOC entry 176 (class 1259 OID 28259)
-- Name: adm_empresa; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE adm_empresa (
    id integer NOT NULL,
    codigo integer,
    nombre_empresa character varying(50),
    rif character varying(20),
    cedula integer,
    nombre character varying(25),
    apellido character varying(25),
    telefono1 character varying(20),
    telefono2 character varying(20),
    correo character varying(40),
    direccion character varying(150),
    logo character varying(500)
);


--
-- TOC entry 177 (class 1259 OID 28265)
-- Name: adm_empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE adm_empresa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2144 (class 0 OID 0)
-- Dependencies: 177
-- Name: adm_empresa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE adm_empresa_id_seq OWNED BY adm_empresa.id;


--
-- TOC entry 207 (class 1259 OID 28434)
-- Name: adm_monedero; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE adm_monedero (
    id integer NOT NULL,
    monedero character varying(34)
);


--
-- TOC entry 206 (class 1259 OID 28432)
-- Name: adm_monedero_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE adm_monedero_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 206
-- Name: adm_monedero_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE adm_monedero_id_seq OWNED BY adm_monedero.id;


--
-- TOC entry 178 (class 1259 OID 28267)
-- Name: auditoria; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE auditoria (
    id integer NOT NULL,
    tabla character varying(200),
    codigo character varying(200),
    accion character varying(200),
    fecha character varying(10) NOT NULL,
    hora character varying(12) NOT NULL,
    usuario integer
);


--
-- TOC entry 179 (class 1259 OID 28273)
-- Name: auditoria_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE auditoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 179
-- Name: auditoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE auditoria_id_seq OWNED BY auditoria.id;


--
-- TOC entry 180 (class 1259 OID 28275)
-- Name: claves_sistema_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE claves_sistema_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2147 (class 0 OID 0)
-- Dependencies: 180
-- Name: claves_sistema_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE claves_sistema_id_seq OWNED BY adm_claves_sistema.id;


--
-- TOC entry 182 (class 1259 OID 28298)
-- Name: conf_grupo_user; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE conf_grupo_user (
    id integer NOT NULL,
    codigo integer,
    name character varying(50) NOT NULL,
    activo boolean,
    user_create integer,
    date_create timestamp without time zone,
    user_update integer,
    date_update timestamp without time zone
);


--
-- TOC entry 183 (class 1259 OID 28301)
-- Name: conf_grupo_user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE conf_grupo_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2148 (class 0 OID 0)
-- Dependencies: 183
-- Name: conf_grupo_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE conf_grupo_user_id_seq OWNED BY conf_grupo_user.id;


--
-- TOC entry 184 (class 1259 OID 28319)
-- Name: conf_tipos_monedas; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE conf_tipos_monedas (
    id integer NOT NULL,
    codigo integer,
    descripcion character varying(50),
    activo boolean,
    abreviatura character(10)
);


--
-- TOC entry 185 (class 1259 OID 28322)
-- Name: conf_tipos_monedas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE conf_tipos_monedas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 185
-- Name: conf_tipos_monedas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE conf_tipos_monedas_id_seq OWNED BY conf_tipos_monedas.id;


--
-- TOC entry 186 (class 1259 OID 28324)
-- Name: ref_rel_links; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_links (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    links character varying(100),
    estatus integer,
    referido_id integer,
    num_link integer,
    fecha character(20),
    verif_pago integer,
    bot_id integer
);


--
-- TOC entry 187 (class 1259 OID 28327)
-- Name: ref_links_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_links_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 187
-- Name: ref_links_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_links_id_seq OWNED BY ref_rel_links.id;


--
-- TOC entry 188 (class 1259 OID 28329)
-- Name: ref_perfil; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_perfil (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    maximo double precision,
    disponible double precision,
    estatus integer,
    referido_id integer,
    t_moneda_id integer,
    tipo_cuenta_id integer,
    num_cuenta_usu character(20),
    banco_usu_id integer,
    cant_ref integer,
    fecha character varying(20),
    nivel integer,
    monto_pago double precision,
    monto_retiro_minimo double precision,
    cargo_mora double precision,
    dir_monedero character(34)
);


--
-- TOC entry 189 (class 1259 OID 28332)
-- Name: ref_perfil_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_perfil_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2151 (class 0 OID 0)
-- Dependencies: 189
-- Name: ref_perfil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_perfil_id_seq OWNED BY ref_perfil.id;


--
-- TOC entry 209 (class 1259 OID 28442)
-- Name: ref_rel_ayudas; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_ayudas (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    motivo integer,
    pregunta character(290),
    fecha_pre character(11),
    estatus integer,
    operador_id integer,
    respuesta character(290),
    fecha_res character(11)
);


--
-- TOC entry 208 (class 1259 OID 28440)
-- Name: ref_rel_ayudas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_rel_ayudas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2152 (class 0 OID 0)
-- Dependencies: 208
-- Name: ref_rel_ayudas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_rel_ayudas_id_seq OWNED BY ref_rel_ayudas.id;


--
-- TOC entry 190 (class 1259 OID 28334)
-- Name: ref_rel_distribucion; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_distribucion (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    referido_id integer,
    fecha character(20),
    monto double precision
);


--
-- TOC entry 191 (class 1259 OID 28337)
-- Name: ref_rel_distribucion_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_rel_distribucion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 191
-- Name: ref_rel_distribucion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_rel_distribucion_id_seq OWNED BY ref_rel_distribucion.id;


--
-- TOC entry 192 (class 1259 OID 28339)
-- Name: ref_rel_pagos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_pagos (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    monto double precision,
    estatus integer,
    tipo_pago integer,
    cuenta_id integer,
    num_pago integer,
    fecha_pago character varying(20),
    operador_id integer,
    fecha_verificacion character varying(20),
    perfil_id integer
);


--
-- TOC entry 193 (class 1259 OID 28342)
-- Name: ref_rel_pagos_bitcoins; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_pagos_bitcoins (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    monto double precision,
    estatus integer,
    dir_monedero character varying(34),
    fecha_pago character varying(20),
    operador_id integer,
    fecha_verificacion character varying(20),
    perfil_id integer,
    hora_pago character varying(12)
);


--
-- TOC entry 194 (class 1259 OID 28345)
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_rel_pagos_bitcoins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2154 (class 0 OID 0)
-- Dependencies: 194
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_rel_pagos_bitcoins_id_seq OWNED BY ref_rel_pagos_bitcoins.id;


--
-- TOC entry 195 (class 1259 OID 28347)
-- Name: ref_rel_pagos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_rel_pagos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 195
-- Name: ref_rel_pagos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_rel_pagos_id_seq OWNED BY ref_rel_pagos.id;


--
-- TOC entry 196 (class 1259 OID 28349)
-- Name: ref_rel_retiros; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_retiros (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    monto double precision,
    estatus integer,
    operador_id integer,
    fecha_verificacion character varying(20),
    num_pago integer,
    fecha_solicitud character(20),
    porcentaje_comision double precision
);


--
-- TOC entry 197 (class 1259 OID 28352)
-- Name: ref_rel_retiros_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_rel_retiros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 197
-- Name: ref_rel_retiros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_rel_retiros_id_seq OWNED BY ref_rel_retiros.id;


--
-- TOC entry 198 (class 1259 OID 28354)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE usuarios (
    id integer NOT NULL,
    codigo integer,
    username character varying(30),
    password character varying(128),
    cedula integer,
    first_name character varying(70),
    last_name character varying(70),
    email character varying(75),
    tipo_usuario character varying(100),
    cargo character varying(100),
    telefono character varying(20),
    estatus boolean,
    picture character varying(500),
    fecha_create timestamp with time zone,
    fecha_update timestamp with time zone,
    user_create_id integer
);


--
-- TOC entry 199 (class 1259 OID 28360)
-- Name: usuarios_desvinculados; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE usuarios_desvinculados (
    id integer NOT NULL,
    usuario character varying(150),
    operador_id integer,
    fecha_desvinculacion character varying(20),
    estatus_perfil integer,
    estatus_pago integer
);


--
-- TOC entry 200 (class 1259 OID 28363)
-- Name: usuarios_desvinculados_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE usuarios_desvinculados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 200
-- Name: usuarios_desvinculados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE usuarios_desvinculados_id_seq OWNED BY usuarios_desvinculados.id;


--
-- TOC entry 201 (class 1259 OID 28365)
-- Name: usuarios_eliminados; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE usuarios_eliminados (
    id integer NOT NULL,
    usuario character varying(150),
    operador_id integer,
    fecha_eliminacion character varying(20)
);


--
-- TOC entry 202 (class 1259 OID 28368)
-- Name: usuarios_eliminados_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE usuarios_eliminados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 202
-- Name: usuarios_eliminados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE usuarios_eliminados_id_seq OWNED BY usuarios_eliminados.id;


--
-- TOC entry 203 (class 1259 OID 28370)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 203
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- TOC entry 204 (class 1259 OID 28372)
-- Name: usuarios_revinculados; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE usuarios_revinculados (
    id integer NOT NULL,
    usuario character varying(150),
    operador_id integer,
    fecha_revinculacion character varying(20)
);


--
-- TOC entry 205 (class 1259 OID 28375)
-- Name: usuarios_revinculados_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE usuarios_revinculados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 205
-- Name: usuarios_revinculados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE usuarios_revinculados_id_seq OWNED BY usuarios_revinculados.id;


--
-- TOC entry 1939 (class 2604 OID 28377)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_asignacion_montos ALTER COLUMN id SET DEFAULT nextval('adm_asignacion_montos_id_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 28378)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_claves_sistema ALTER COLUMN id SET DEFAULT nextval('claves_sistema_id_seq'::regclass);


--
-- TOC entry 1941 (class 2604 OID 28379)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_cuentas_bot ALTER COLUMN id SET DEFAULT nextval('adm_cuentas_bot_id_seq'::regclass);


--
-- TOC entry 1942 (class 2604 OID 28380)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_empresa ALTER COLUMN id SET DEFAULT nextval('adm_empresa_id_seq'::regclass);


--
-- TOC entry 1956 (class 2604 OID 28437)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_monedero ALTER COLUMN id SET DEFAULT nextval('adm_monedero_id_seq'::regclass);


--
-- TOC entry 1943 (class 2604 OID 28381)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY auditoria ALTER COLUMN id SET DEFAULT nextval('auditoria_id_seq'::regclass);


--
-- TOC entry 1944 (class 2604 OID 28385)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY conf_grupo_user ALTER COLUMN id SET DEFAULT nextval('conf_grupo_user_id_seq'::regclass);


--
-- TOC entry 1945 (class 2604 OID 28388)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY conf_tipos_monedas ALTER COLUMN id SET DEFAULT nextval('conf_tipos_monedas_id_seq'::regclass);


--
-- TOC entry 1947 (class 2604 OID 28389)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_perfil ALTER COLUMN id SET DEFAULT nextval('ref_perfil_id_seq'::regclass);


--
-- TOC entry 1957 (class 2604 OID 28445)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_ayudas ALTER COLUMN id SET DEFAULT nextval('ref_rel_ayudas_id_seq'::regclass);


--
-- TOC entry 1948 (class 2604 OID 28390)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_distribucion ALTER COLUMN id SET DEFAULT nextval('ref_rel_distribucion_id_seq'::regclass);


--
-- TOC entry 1946 (class 2604 OID 28391)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_links ALTER COLUMN id SET DEFAULT nextval('ref_links_id_seq'::regclass);


--
-- TOC entry 1949 (class 2604 OID 28392)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_pagos ALTER COLUMN id SET DEFAULT nextval('ref_rel_pagos_id_seq'::regclass);


--
-- TOC entry 1950 (class 2604 OID 28393)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_pagos_bitcoins ALTER COLUMN id SET DEFAULT nextval('ref_rel_pagos_bitcoins_id_seq'::regclass);


--
-- TOC entry 1951 (class 2604 OID 28394)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_retiros ALTER COLUMN id SET DEFAULT nextval('ref_rel_retiros_id_seq'::regclass);


--
-- TOC entry 1952 (class 2604 OID 28395)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- TOC entry 1953 (class 2604 OID 28396)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios_desvinculados ALTER COLUMN id SET DEFAULT nextval('usuarios_desvinculados_id_seq'::regclass);


--
-- TOC entry 1954 (class 2604 OID 28397)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios_eliminados ALTER COLUMN id SET DEFAULT nextval('usuarios_eliminados_id_seq'::regclass);


--
-- TOC entry 1955 (class 2604 OID 28398)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios_revinculados ALTER COLUMN id SET DEFAULT nextval('usuarios_revinculados_id_seq'::regclass);


--
-- TOC entry 2095 (class 0 OID 28246)
-- Dependencies: 171
-- Data for Name: adm_asignacion_montos; Type: TABLE DATA; Schema: public; Owner: -
--

--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 172
-- Name: adm_asignacion_montos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_asignacion_montos_id_seq', 1, false);


--
-- TOC entry 2097 (class 0 OID 28251)
-- Dependencies: 173
-- Data for Name: adm_claves_sistema; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_claves_sistema (id, clave, fecha, hora, user_create) VALUES (1, 'pbkdf2_sha256$12000$ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2016-10-29', '18:45:00 pm', 4);


--
-- TOC entry 2105 (class 0 OID 28285)
-- Dependencies: 181
-- Data for Name: adm_comision_retiro; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 175
-- Name: adm_cuentas_bot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_cuentas_bot_id_seq', 1, false);


--
-- TOC entry 2100 (class 0 OID 28259)
-- Dependencies: 176
-- Data for Name: adm_empresa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_empresa (id, codigo, nombre_empresa, rif, cedula, nombre, apellido, telefono1, telefono2, correo, direccion, logo) VALUES (1, NULL, 'CRIPTO ZONE', '', 19258456, 'NINOSKA VANESSA', 'NATERA HERNANDEZ', '(0416) 528-9636', '(0416) 654-6498', 'criptozona@gmail.com', 'Av. Sucre Las Delicias Maracay', '');


--
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 177
-- Name: adm_empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_empresa_id_seq', 1, false);


--
-- TOC entry 2131 (class 0 OID 28434)
-- Dependencies: 207
-- Data for Name: adm_monedero; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 206
-- Name: adm_monedero_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_monedero_id_seq', 1, false);


--
-- TOC entry 2102 (class 0 OID 28267)
-- Dependencies: 178
-- Data for Name: auditoria; Type: TABLE DATA; Schema: public; Owner: -
--

--
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 179
-- Name: auditoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('auditoria_id_seq', 702, true);


--
-- TOC entry 2166 (class 0 OID 0)
-- Dependencies: 180
-- Name: claves_sistema_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('claves_sistema_id_seq', 1, false);


--
-- TOC entry 2106 (class 0 OID 28298)
-- Dependencies: 182
-- Data for Name: conf_grupo_user; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (1, 1, 'Administrador', true, NULL, NULL, NULL, NULL);
INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (2, 2, 'OPERADOR', true, 2, NULL, NULL, NULL);
INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (3, 3, 'BÁSICO', true, 2, NULL, NULL, NULL);
INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (4, 4, 'BOTS', true, 1, NULL, NULL, NULL);


--
-- TOC entry 2167 (class 0 OID 0)
-- Dependencies: 183
-- Name: conf_grupo_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('conf_grupo_user_id_seq', 1, false);


--
-- TOC entry 2108 (class 0 OID 28319)
-- Dependencies: 184
-- Data for Name: conf_tipos_monedas; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (1, 1, 'BITCOINS', true, 'Bit       ');
INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (2, 2, 'BOLÍVARES', true, 'BS        ');
INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (3, 3, 'DOLARES', true, '$         ');
INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (4, 4, 'EUROS', true, '€         ');


--
-- TOC entry 2168 (class 0 OID 0)
-- Dependencies: 185
-- Name: conf_tipos_monedas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('conf_tipos_monedas_id_seq', 1, false);


--
-- TOC entry 2169 (class 0 OID 0)
-- Dependencies: 187
-- Name: ref_links_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_links_id_seq', 1, false);



--
-- TOC entry 2170 (class 0 OID 0)
-- Dependencies: 189
-- Name: ref_perfil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_perfil_id_seq', 1, false);


--
-- TOC entry 2133 (class 0 OID 28442)
-- Dependencies: 209
-- Data for Name: ref_rel_ayudas; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2171 (class 0 OID 0)
-- Dependencies: 208
-- Name: ref_rel_ayudas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_ayudas_id_seq', 4, true);


--
-- TOC entry 2114 (class 0 OID 28334)
-- Dependencies: 190
-- Data for Name: ref_rel_distribucion; Type: TABLE DATA; Schema: public; Owner: -
--


--
-- TOC entry 2172 (class 0 OID 0)
-- Dependencies: 191
-- Name: ref_rel_distribucion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_distribucion_id_seq', 32, true);


--
-- TOC entry 2110 (class 0 OID 28324)
-- Dependencies: 186
-- Data for Name: ref_rel_links; Type: TABLE DATA; Schema: public; Owner: -
--

--
-- TOC entry 2116 (class 0 OID 28339)
-- Dependencies: 192
-- Data for Name: ref_rel_pagos; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2117 (class 0 OID 28342)
-- Dependencies: 193
-- Data for Name: ref_rel_pagos_bitcoins; Type: TABLE DATA; Schema: public; Owner: -
--


--
-- TOC entry 2173 (class 0 OID 0)
-- Dependencies: 194
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_pagos_bitcoins_id_seq', 1, false);


--
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 195
-- Name: ref_rel_pagos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_pagos_id_seq', 1, false);


--
-- TOC entry 2120 (class 0 OID 28349)
-- Dependencies: 196
-- Data for Name: ref_rel_retiros; Type: TABLE DATA; Schema: public; Owner: -
--

--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 197
-- Name: ref_rel_retiros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_retiros_id_seq', 1, true);


--
-- TOC entry 2122 (class 0 OID 28354)
-- Dependencies: 198
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (1, 1, 'admin', 'pbkdf2_sha256$12000$8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 12345678, 'ADMIN', 'ADMIN', 'admin@gmail.com', '1', NULL, '04161073358', true, NULL, NULL, NULL, NULL);

--
-- TOC entry 2123 (class 0 OID 28360)
-- Dependencies: 199
-- Data for Name: usuarios_desvinculados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 200
-- Name: usuarios_desvinculados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_desvinculados_id_seq', 1, false);


--
-- TOC entry 2125 (class 0 OID 28365)
-- Dependencies: 201
-- Data for Name: usuarios_eliminados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 202
-- Name: usuarios_eliminados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_eliminados_id_seq', 1, false);


--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 203
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_id_seq', 19, true);


--
-- TOC entry 2128 (class 0 OID 28372)
-- Dependencies: 204
-- Data for Name: usuarios_revinculados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 205
-- Name: usuarios_revinculados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_revinculados_id_seq', 1, false);


--
-- TOC entry 1959 (class 2606 OID 28400)
-- Name: asig_monto_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY adm_asignacion_montos
    ADD CONSTRAINT asig_monto_key PRIMARY KEY (id);


--
-- TOC entry 1963 (class 2606 OID 28402)
-- Name: auditoria_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT auditoria_key PRIMARY KEY (id);


--
-- TOC entry 1987 (class 2606 OID 28450)
-- Name: ayuda_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_ayudas
    ADD CONSTRAINT ayuda_key PRIMARY KEY (id);


--
-- TOC entry 1961 (class 2606 OID 28404)
-- Name: bots_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY adm_cuentas_bot
    ADD CONSTRAINT bots_key PRIMARY KEY (id);


--
-- TOC entry 1965 (class 2606 OID 28408)
-- Name: grupos_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY conf_grupo_user
    ADD CONSTRAINT grupos_key PRIMARY KEY (id);


--
-- TOC entry 1981 (class 2606 OID 28410)
-- Name: id_desv_primary_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios_desvinculados
    ADD CONSTRAINT id_desv_primary_key PRIMARY KEY (id);


--
-- TOC entry 1983 (class 2606 OID 28412)
-- Name: id_primary_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios_eliminados
    ADD CONSTRAINT id_primary_key PRIMARY KEY (id);


--
-- TOC entry 1985 (class 2606 OID 28414)
-- Name: id_rev_primary_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios_revinculados
    ADD CONSTRAINT id_rev_primary_key PRIMARY KEY (id);


--
-- TOC entry 1969 (class 2606 OID 28416)
-- Name: link_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_links
    ADD CONSTRAINT link_key PRIMARY KEY (id);


--
-- TOC entry 1975 (class 2606 OID 28418)
-- Name: pagos_bit_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_pagos_bitcoins
    ADD CONSTRAINT pagos_bit_key PRIMARY KEY (id);


--
-- TOC entry 1973 (class 2606 OID 28420)
-- Name: pagos_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_pagos
    ADD CONSTRAINT pagos_key PRIMARY KEY (id);


--
-- TOC entry 1971 (class 2606 OID 28422)
-- Name: prefil_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_perfil
    ADD CONSTRAINT prefil_key PRIMARY KEY (id);


--
-- TOC entry 1977 (class 2606 OID 28424)
-- Name: ref_rel_retiros_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_retiros
    ADD CONSTRAINT ref_rel_retiros_key PRIMARY KEY (id);


--
-- TOC entry 1967 (class 2606 OID 28428)
-- Name: tipo_moneda_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY conf_tipos_monedas
    ADD CONSTRAINT tipo_moneda_key PRIMARY KEY (id);


--
-- TOC entry 1979 (class 2606 OID 28430)
-- Name: usuarios_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_key PRIMARY KEY (id);


-- Completed on 2017-08-16 21:17:49

--
-- PostgreSQL database dump complete
--

