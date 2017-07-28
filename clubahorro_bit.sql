--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.14
-- Dumped by pg_dump version 9.3.14
-- Started on 2017-07-27 23:55:59

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
-- TOC entry 2128 (class 0 OID 0)
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
-- TOC entry 2129 (class 0 OID 0)
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
-- TOC entry 2130 (class 0 OID 0)
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
-- TOC entry 2131 (class 0 OID 0)
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
-- TOC entry 2132 (class 0 OID 0)
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
-- TOC entry 2133 (class 0 OID 0)
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
-- TOC entry 2134 (class 0 OID 0)
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
-- TOC entry 2135 (class 0 OID 0)
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
-- TOC entry 2136 (class 0 OID 0)
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
-- TOC entry 2137 (class 0 OID 0)
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
-- TOC entry 2138 (class 0 OID 0)
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
-- TOC entry 2139 (class 0 OID 0)
-- Dependencies: 189
-- Name: ref_perfil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_perfil_id_seq OWNED BY ref_perfil.id;


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
-- TOC entry 2140 (class 0 OID 0)
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
    perfil_id integer
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
-- TOC entry 2141 (class 0 OID 0)
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
-- TOC entry 2142 (class 0 OID 0)
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
-- TOC entry 2143 (class 0 OID 0)
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
-- TOC entry 2144 (class 0 OID 0)
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
-- TOC entry 2145 (class 0 OID 0)
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
-- TOC entry 2146 (class 0 OID 0)
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
-- TOC entry 2147 (class 0 OID 0)
-- Dependencies: 205
-- Name: usuarios_revinculados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE usuarios_revinculados_id_seq OWNED BY usuarios_revinculados.id;


--
-- TOC entry 1932 (class 2604 OID 28377)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_asignacion_montos ALTER COLUMN id SET DEFAULT nextval('adm_asignacion_montos_id_seq'::regclass);


--
-- TOC entry 1933 (class 2604 OID 28378)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_claves_sistema ALTER COLUMN id SET DEFAULT nextval('claves_sistema_id_seq'::regclass);


--
-- TOC entry 1934 (class 2604 OID 28379)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_cuentas_bot ALTER COLUMN id SET DEFAULT nextval('adm_cuentas_bot_id_seq'::regclass);


--
-- TOC entry 1935 (class 2604 OID 28380)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_empresa ALTER COLUMN id SET DEFAULT nextval('adm_empresa_id_seq'::regclass);


--
-- TOC entry 1949 (class 2604 OID 28437)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY adm_monedero ALTER COLUMN id SET DEFAULT nextval('adm_monedero_id_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 28381)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY auditoria ALTER COLUMN id SET DEFAULT nextval('auditoria_id_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 28385)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY conf_grupo_user ALTER COLUMN id SET DEFAULT nextval('conf_grupo_user_id_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 28388)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY conf_tipos_monedas ALTER COLUMN id SET DEFAULT nextval('conf_tipos_monedas_id_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 28389)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_perfil ALTER COLUMN id SET DEFAULT nextval('ref_perfil_id_seq'::regclass);


--
-- TOC entry 1941 (class 2604 OID 28390)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_distribucion ALTER COLUMN id SET DEFAULT nextval('ref_rel_distribucion_id_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 28391)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_links ALTER COLUMN id SET DEFAULT nextval('ref_links_id_seq'::regclass);


--
-- TOC entry 1942 (class 2604 OID 28392)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_pagos ALTER COLUMN id SET DEFAULT nextval('ref_rel_pagos_id_seq'::regclass);


--
-- TOC entry 1943 (class 2604 OID 28393)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_pagos_bitcoins ALTER COLUMN id SET DEFAULT nextval('ref_rel_pagos_bitcoins_id_seq'::regclass);


--
-- TOC entry 1944 (class 2604 OID 28394)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_retiros ALTER COLUMN id SET DEFAULT nextval('ref_rel_retiros_id_seq'::regclass);


--
-- TOC entry 1945 (class 2604 OID 28395)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- TOC entry 1946 (class 2604 OID 28396)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios_desvinculados ALTER COLUMN id SET DEFAULT nextval('usuarios_desvinculados_id_seq'::regclass);


--
-- TOC entry 1947 (class 2604 OID 28397)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios_eliminados ALTER COLUMN id SET DEFAULT nextval('usuarios_eliminados_id_seq'::regclass);


--
-- TOC entry 1948 (class 2604 OID 28398)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY usuarios_revinculados ALTER COLUMN id SET DEFAULT nextval('usuarios_revinculados_id_seq'::regclass);


--
-- TOC entry 2085 (class 0 OID 28246)
-- Dependencies: 171
-- Data for Name: adm_asignacion_montos; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_asignacion_montos (id, codigo, porcentaje1, porcentaje2, porcentaje3, porcentaje4, porcentaje5, porcentaje6, porcentaje7, porcentaje8) VALUES (1, NULL, 20, 10, 10, 10, 10, 10, 10, 20);


--
-- TOC entry 2148 (class 0 OID 0)
-- Dependencies: 172
-- Name: adm_asignacion_montos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_asignacion_montos_id_seq', 1, false);


--
-- TOC entry 2087 (class 0 OID 28251)
-- Dependencies: 173
-- Data for Name: adm_claves_sistema; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_claves_sistema (id, clave, fecha, hora, user_create) VALUES (1, 'pbkdf2_sha256$12000$ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2016-10-29', '18:45:00 pm', 4);


--
-- TOC entry 2095 (class 0 OID 28285)
-- Dependencies: 181
-- Data for Name: adm_comision_retiro; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_comision_retiro (id, codigo, porcentaje_comision, fecha_create, fecha_update, user_create, user_update) VALUES (1, 1, 7, '2016-12-16', '2017-07-28', '1', '1');


--
-- TOC entry 2088 (class 0 OID 28254)
-- Dependencies: 174
-- Data for Name: adm_cuentas_bot; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_cuentas_bot (id, moneda, monto_pago, monto_retiro_minimo, fecha, user_create, cargo_mora) VALUES (1, 1, 1000, 50, '2017-07-26 ', 1, 10);


--
-- TOC entry 2149 (class 0 OID 0)
-- Dependencies: 175
-- Name: adm_cuentas_bot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_cuentas_bot_id_seq', 1, false);


--
-- TOC entry 2090 (class 0 OID 28259)
-- Dependencies: 176
-- Data for Name: adm_empresa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_empresa (id, codigo, nombre_empresa, rif, cedula, nombre, apellido, telefono1, telefono2, correo, direccion, logo) VALUES (1, NULL, 'CLUB AHORRO', '', 19258456, 'NINOSKA VANESSA', 'NATERA HERNANDEZ', '(0416) 528-9636', '(0416) 654-6498', 'clubahorro@gmail.com', 'Av. Sucre Las Delicias Maracay', '');


--
-- TOC entry 2150 (class 0 OID 0)
-- Dependencies: 177
-- Name: adm_empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_empresa_id_seq', 1, false);


--
-- TOC entry 2121 (class 0 OID 28434)
-- Dependencies: 207
-- Data for Name: adm_monedero; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO adm_monedero (id, monedero) VALUES (1, 'JGQko7DZfuNqgyMkiSM6TKJBmAMCHhZPPP');


--
-- TOC entry 2151 (class 0 OID 0)
-- Dependencies: 206
-- Name: adm_monedero_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('adm_monedero_id_seq', 1, false);


--
-- TOC entry 2092 (class 0 OID 28267)
-- Dependencies: 178
-- Data for Name: auditoria; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (1, '', '', 'Cerrada la Sesión', '2016-12-15', '03:50:09 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (2, '', '', 'Inicio de Sesion', '2016-12-16', '10:51:00 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (3, '', '', 'Inicio de Sesion', '2016-12-16', '11:08:07 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (4, 'Grupos Usuarios', '4', 'Nuevo Grupos Usuarios', '2016-12-16', '11:09:00 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (5, 'Comision Retiro', '1', 'Registro de nueva Comision Retiro', '2016-12-16', '11:16:02 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (6, '', '', 'Cerrada la Sesión', '2016-12-16', '11:28:56 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (7, '', '', 'Cerrada la Sesión', '2016-12-16', '11:54:50 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (8, '', '', 'Inicio de Sesion', '2016-12-16', '01:57:38 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (9, '', '', 'Cerrada la Sesión', '2016-12-16', '02:30:21 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (10, '', '', 'Cerrada la Sesión', '2016-12-16', '02:34:57 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (11, '', '', 'Cerrada la Sesión', '2016-12-16', '02:36:24 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (12, '', '', 'Cerrada la Sesión', '2016-12-16', '02:36:48 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (13, '', '', 'Cerrada la Sesión', '2016-12-16', '02:37:02 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (14, '', '', 'Cerrada la Sesión', '2016-12-16', '02:37:14 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (15, '', '', 'Cerrada la Sesión', '2016-12-16', '02:37:35 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (16, '', '', 'Cerrada la Sesión', '2016-12-16', '02:43:24 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (17, '', '', 'Inicio de Sesion', '2016-12-16', '02:43:34 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (18, '', '', 'Cerrada la Sesión', '2016-12-16', '02:52:56 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (19, '', '', 'Inicio de Sesion', '2016-12-16', '02:53:02 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (20, '', '', 'Cerrada la Sesión', '2016-12-16', '02:53:28 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (21, '', '', 'Inicio de Sesion', '2016-12-16', '02:53:32 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (22, '', '', 'Cerrada la Sesión', '2016-12-16', '03:00:51 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (23, '', '', 'Inicio de Sesion', '2016-12-16', '03:27:18 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (24, 'Tipos de Cuenta', '1', 'Registro de Nuevo Tipo de Cuenta', '2016-12-16', '03:27:56 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (25, 'Tipos de Cuenta', '2', 'Registro de Nuevo Tipo de Cuenta', '2016-12-16', '03:27:56 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (26, '', '', 'Inicio de Sesion', '2017-06-09', '11:52:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (27, 'Cuentas Bot', '1', 'Registro de Nueva Cuenta', '2017-06-09', '11:54:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (28, 'Usuarios', '2', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (29, 'Usuarios', '3', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (30, 'Usuarios', '4', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (31, 'Usuarios', '5', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (32, 'Usuarios', '6', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (33, 'Usuarios', '7', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (34, 'Usuarios', '8', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (35, 'Links', '1', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (36, 'Links', '2', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (37, 'Links', '3', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (38, 'Links', '4', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (39, 'Links', '5', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (40, 'Usuarios', '9', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (41, 'Links', '6', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (42, 'Links', '7', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (43, 'Links', '8', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (44, 'Links', '9', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (45, 'Links', '10', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (46, 'Usuarios', '10', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (47, 'Links', '11', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (48, 'Links', '12', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (49, 'Links', '13', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (50, 'Links', '14', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (51, 'Links', '15', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (52, 'Usuarios', '11', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (53, 'Links', '16', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (54, 'Links', '17', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (55, 'Links', '18', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (56, 'Links', '19', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (57, 'Links', '20', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (58, 'Usuarios', '12', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (59, 'Links', '21', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (60, 'Links', '22', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (61, 'Links', '23', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (62, 'Links', '24', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (63, 'Links', '25', 'Registro de Nuevo Link', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (64, 'Usuarios', '13', 'Registro de Nuevo Usuario', '2017-06-09', '11:54:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (65, '', '', 'Cerrada la Sesión', '2017-06-09', '11:55:18 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (66, '', '', 'Inicio de Sesion', '2017-06-09', '11:55:58 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (67, '', '', 'Cerrada la Sesión', '2017-06-11', '01:15:27 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (68, '', '', 'Cerrada la Sesión', '2017-06-11', '02:56:31 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (69, '', '', 'Inicio de Sesion', '2017-06-11', '02:56:42 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (70, '', '', 'Inicio de Sesion', '2017-06-11', '03:16:24 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (71, '', '', 'Cerrada la Sesión', '2017-06-11', '03:20:02 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (72, '', '', 'Inicio de Sesion', '2017-06-11', '03:20:09 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (73, 'Tipos de Cuenta', '1', 'Registro de nueva Cuenta: 12345678910111213141', '2017-06-11', '03:22:02 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (74, '', '', 'Cerrada la Sesión', '2017-06-11', '03:22:23 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (75, '', '', 'Inicio de Sesion', '2017-06-11', '03:22:31 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (76, 'RelPagos', '1', 'Actualización Pago al sistema', '2017-06-11', '03 :23:53 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (77, '', '', 'Cerrada la Sesión', '2017-06-11', '03:25:12 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (78, '', '', 'Inicio de Sesion', '2017-06-11', '03:25:27 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (79, 'Usuarios', '15', 'Registro de nuevo Usuario', '2017-06-11', '03:26:56 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (80, '', '', 'Cerrada la Sesión', '2017-06-11', '03:27:03 pm', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (81, '', '', 'Inicio de Sesion', '2017-06-11', '03:27:23 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (82, 'ref_perfil', '13', 'Actualización de Perfil', '2017-06-11', '03:27:47 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (83, '', '', 'Cerrada la Sesión', '2017-06-11', '03:28:36 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (84, '', '', 'Inicio de Sesion', '2017-06-11', '03:28:46 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (85, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-06-11', '03:43:55 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (86, 'Rel Distribución', '18', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:44:49 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (87, 'Rel Distribución', '19', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:44:57 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (88, 'Rel Distribución', '20', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:45:09 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (89, 'Rel Distribución', '21', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:45:23 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (90, 'Rel Distribución', '22', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:45:31 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (91, 'Rel Distribución', '23', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:45:38 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (92, 'Rel Distribución', '24', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:45:53 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (93, 'Rel Distribución', '25', 'Nueva Pago de distribucion de capital', '2017-06-11', '03:48:06 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (94, 'RelLinks', '14', 'Generacion de Links de invitación usuario:jsolorzano', '2017-06-11', '03:55:43 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (95, '', '', 'Inicio de Sesion', '2017-06-11', '06:13:47 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (96, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-06-11', '06:14:22 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (97, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-06-11', '06:14:29 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (98, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-06-11', '06:18:17 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (99, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-06-11', '06:18:34 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (100, '', '', 'Cerrada la Sesión', '2017-06-11', '06:45:19 pm', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (101, '', '', 'Inicio de Sesion', '2017-06-11', '07:03:16 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (102, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:08 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (103, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:11 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (104, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:12 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (105, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:12 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (106, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:12 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (107, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:13 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (108, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:13 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (109, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:13 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (110, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:14 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (111, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:14 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (112, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:14 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (113, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:14 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (114, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:15 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (115, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:15 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (116, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:15 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (117, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:15 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (118, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:15 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (119, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:16 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (120, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:16 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (121, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:16 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (122, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:20 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (123, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:21 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (124, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:22 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (125, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:22 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (126, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:23 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (127, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:23 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (128, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:23 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (129, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:24 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (130, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:24 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (131, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:28 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (132, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:34 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (133, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:34 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (134, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:34 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (135, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:34 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (136, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:35 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (137, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:35 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (138, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:35 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (139, '', '', 'Cerrada la Sesión', '2017-06-11', '07:12:35 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (140, '', '', 'Inicio de Sesion', '2017-06-11', '07:12:47 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (141, 'RelPagos', '3', 'Actualización Pago al sistema', '2017-06-11', '07 :15:52 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (142, '', '', 'Cerrada la Sesión', '2017-06-11', '07:16:16 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (143, '', '', 'Inicio de Sesion', '2017-06-11', '07:17:03 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (144, 'RelPagos', '3', 'Actualización Pago al sistema', '2017-06-11', '07 :17:27 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (145, '', '', 'Cerrada la Sesión', '2017-06-11', '07:17:49 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (146, '', '', 'Inicio de Sesion', '2017-06-11', '07:17:59 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (147, 'ref_perfil', '14', 'Actualización de Perfil', '2017-06-11', '07:18:18 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (148, '', '', 'Cerrada la Sesión', '2017-06-11', '07:18:35 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (149, '', '', 'Inicio de Sesion', '2017-06-11', '07:18:42 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (150, 'Perfiles', '19145888', 'Edición de perfil de usuario: marcuri', '2017-06-11', '07:23:20 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (151, 'Rel Distribución', '26', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:24:04 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (152, 'Rel Distribución', '27', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:25:07 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (153, 'Rel Distribución', '28', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:28:13 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (154, 'Rel Distribución', '29', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:28:28 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (155, 'Rel Distribución', '30', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:28:36 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (156, 'Rel Distribución', '31', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:28:45 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (157, 'Rel Distribución', '32', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:28:52 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (158, 'Rel Distribución', '33', 'Nueva Pago de distribucion de capital', '2017-06-11', '07:29:01 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (159, '', '', 'Cerrada la Sesión', '2017-06-11', '07:30:14 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (160, '', '', 'Cerrada la Sesión', '2017-06-11', '07:30:25 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (161, '', '', 'Cerrada la Sesión', '2017-06-11', '07:30:25 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (162, '', '', 'Cerrada la Sesión', '2017-06-11', '07:30:25 pm', 16);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (163, '', '', 'Inicio de Sesion', '2017-06-11', '07:30:55 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (164, '', '', 'Cerrada la Sesión', '2017-06-11', '08:00:04 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (165, '', '', 'Cerrada la Sesión', '2017-06-11', '08:00:12 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (166, '', '', 'Cerrada la Sesión', '2017-06-11', '08:00:13 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (167, '', '', 'Cerrada la Sesión', '2017-06-11', '08:00:13 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (168, '', '', 'Cerrada la Sesión', '2017-06-11', '08:00:14 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (169, '', '', 'Cerrada la Sesión', '2017-06-11', '08:00:14 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (170, '', '', 'Inicio de Sesion', '2017-06-11', '08:00:25 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (171, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :13:51 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (172, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :18:02 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (173, '', '', 'Cerrada la Sesión', '2017-06-11', '08:20:18 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (174, '', '', 'Inicio de Sesion', '2017-06-11', '08:20:32 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (175, '', '', 'Inicio de Sesion', '2017-06-11', '08:21:03 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (176, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :21:56 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (177, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :24:56 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (178, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :26:30 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (179, 'Perfiles', '19258741', 'Edición de perfil de usuario: fmedina', '2017-06-11', '08:27:42 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (180, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :31:17 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (181, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :34:14 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (182, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :34:28 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (183, '', '', 'Inicio de Sesion', '2017-06-11', '08:34:50 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (184, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :34:55 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (185, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :35:26 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (186, '', '', 'Cerrada la Sesión', '2017-06-11', '08:36:13 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (187, '', '', 'Inicio de Sesion', '2017-06-11', '08:36:31 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (188, 'ref_perfil', '15', 'Actualización de Perfil', '2017-06-11', '08:36:52 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (189, '', '', 'Cerrada la Sesión', '2017-06-11', '08:37:03 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (190, '', '', 'Cerrada la Sesión', '2017-06-11', '08:37:08 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (191, '', '', 'Cerrada la Sesión', '2017-06-11', '08:37:08 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (192, '', '', 'Cerrada la Sesión', '2017-06-11', '08:37:08 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (193, '', '', 'Inicio de Sesion', '2017-06-11', '08:37:18 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (194, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :37:49 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (195, 'Perfiles', '19154854', 'Edición de perfil de usuario: fmedina', '2017-06-11', '08:38:31 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (196, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :52:24 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (197, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :57:20 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (198, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :57:54 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (199, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '08 :58:16 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (200, '', '', 'Cerrada la Sesión', '2017-06-11', '08:59:12 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (201, '', '', 'Inicio de Sesion', '2017-06-11', '08:59:19 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (202, 'ref_perfil', '15', 'Actualización de Perfil', '2017-06-11', '08:59:41 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (203, '', '', 'Cerrada la Sesión', '2017-06-11', '08:59:48 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (204, '', '', 'Inicio de Sesion', '2017-06-11', '09:00:40 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (205, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '09 :00:45 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (206, '', '', 'Cerrada la Sesión', '2017-06-11', '09:01:35 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (207, '', '', 'Inicio de Sesion', '2017-06-11', '09:01:46 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (208, '', '', 'Cerrada la Sesión', '2017-06-11', '09:02:17 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (209, '', '', 'Inicio de Sesion', '2017-06-11', '09:02:30 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (210, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '09 :02:41 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (211, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '09 :02:54 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (212, 'Perfiles', '19154854', 'Edición de perfil de usuario: fmedina', '2017-06-11', '09:03:03 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (213, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '09 :09:07 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (214, 'Perfiles', '19154854', 'Edición de perfil de usuario: fmedina', '2017-06-11', '09:09:45 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (215, 'Perfiles', '19154854', 'Edición de perfil de usuario: fmedina', '2017-06-11', '09:12:13 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (216, 'Perfiles', '19154854', 'Edición de perfil de usuario: fmedina', '2017-06-11', '09:12:28 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (217, 'RelPagos', '4', 'Actualización Pago al sistema', '2017-06-11', '09 :17:15 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (218, 'Perfiles', '19154854', 'Edición de perfil de usuario: fmedina', '2017-06-11', '09:42:40 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (219, '', '', 'Inicio de Sesion', '2017-06-11', '10:26:38 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (220, '', '', 'Cerrada la Sesión', '2017-06-11', '10:30:59 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (221, '', '', 'Inicio de Sesion', '2017-06-11', '10:31:09 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (222, '', '', 'Inicio de Sesion', '2017-06-11', '10:31:31 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (223, 'Rel Distribución', '34', 'Nueva Pago de distribucion de capital', '2017-06-11', '10:32:23 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (224, '', '', 'Cerrada la Sesión', '2017-06-11', '10:38:24 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (225, '', '', 'Inicio de Sesion', '2017-06-11', '10:38:35 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (226, '', '', 'Inicio de Sesion', '2017-06-11', '11:11:10 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (227, 'Rel Distribución', '35', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:19:19 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (228, 'Rel Distribución', '36', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:20:26 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (229, '', '', 'Cerrada la Sesión', '2017-06-11', '11:20:51 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (230, '', '', 'Inicio de Sesion', '2017-06-11', '11:20:59 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (231, 'Rel Distribución', '37', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:21:08 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (232, '', '', 'Inicio de Sesion', '2017-06-11', '11:21:35 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (233, 'Rel Distribución', '38', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:22:14 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (234, 'Rel Distribución', '39', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:23:43 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (235, 'Rel Distribución', '40', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:34:08 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (236, 'Rel Distribución', '41', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:34:21 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (237, '', '', 'Cerrada la Sesión', '2017-06-11', '11:34:56 pm', 17);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (238, '', '', 'Inicio de Sesion', '2017-06-11', '11:35:44 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (239, 'RelPagos', '5', 'Actualización Pago al sistema', '2017-06-11', '11 :36:21 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (240, 'RelPagos', '5', 'Actualización Pago al sistema', '2017-06-11', '11 :36:42 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (241, 'RelPagos', '5', 'Actualización Pago al sistema', '2017-06-11', '11 :37:00 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (242, '', '', 'Cerrada la Sesión', '2017-06-11', '11:38:17 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (243, '', '', 'Inicio de Sesion', '2017-06-11', '11:38:45 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (244, 'RelPagos', '5', 'Actualización Pago al sistema', '2017-06-11', '11 :38:55 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (245, '', '', 'Cerrada la Sesión', '2017-06-11', '11:39:03 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (246, '', '', 'Inicio de Sesion', '2017-06-11', '11:39:25 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (247, 'ref_perfil', '16', 'Actualización de Perfil', '2017-06-11', '11:39:46 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (248, '', '', 'Cerrada la Sesión', '2017-06-11', '11:40:03 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (249, '', '', 'Inicio de Sesion', '2017-06-11', '11:40:12 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (250, 'Perfiles', '19112593', 'Edición de perfil de usuario: jlaya', '2017-06-11', '11:42:41 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (251, 'Rel Distribución', '42', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:43:04 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (252, 'Rel Distribución', '43', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:43:10 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (253, 'Rel Distribución', '44', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:43:45 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (254, 'Rel Distribución', '45', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:43:52 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (255, 'Rel Distribución', '46', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:44:07 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (256, 'Rel Distribución', '47', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:44:21 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (257, 'Rel Distribución', '48', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:44:28 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (258, 'Rel Distribución', '49', 'Nueva Pago de distribucion de capital', '2017-06-11', '11:44:38 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (259, '', '', 'Cerrada la Sesión', '2017-06-11', '11:46:15 pm', 18);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (260, '', '', 'Inicio de Sesion', '2017-06-11', '11:47:01 pm', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (261, 'RelPagos', '6', 'Actualización Pago al sistema', '2017-06-11', '11 :58:26 pm', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (262, 'RelPagos', '6', 'Actualización Pago al sistema', '2017-06-11', '11 :58:43 pm', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (263, '', '', 'Cerrada la Sesión', '2017-06-11', '11:58:51 pm', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (264, '', '', 'Inicio de Sesion', '2017-06-11', '11:59:00 pm', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (265, '', '', 'Cerrada la Sesión', '2017-06-11', '11:59:07 pm', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (266, '', '', 'Inicio de Sesion', '2017-06-11', '11:59:19 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (267, 'ref_perfil', '17', 'Actualización de Perfil', '2017-06-11', '11:59:42 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (268, '', '', 'Cerrada la Sesión', '2017-06-11', '11:59:54 pm', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (269, '', '', 'Inicio de Sesion', '2017-06-12', '12:00:03 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (270, 'Perfiles', '21524444', 'Edición de perfil de usuario: jmiguel', '2017-06-12', '12:01:44 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (271, 'Rel Distribución', '50', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:02:12 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (272, 'Rel Distribución', '51', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:02:18 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (273, 'Rel Distribución', '52', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:02:34 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (274, 'Rel Distribución', '53', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:02:56 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (275, 'Rel Distribución', '54', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:03:09 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (276, 'Rel Distribución', '55', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:03:18 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (277, 'Rel Distribución', '56', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:03:31 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (278, 'Rel Distribución', '57', 'Nueva Pago de distribucion de capital', '2017-06-12', '12:03:39 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (279, '', '', 'Cerrada la Sesión', '2017-06-12', '12:03:56 am', 19);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (280, '', '', 'Inicio de Sesion', '2017-07-26', '12:28:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (281, 'Cuentas Bot', '1', 'Registro de Nueva Cuenta', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (282, 'Usuarios', '2', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (283, 'Usuarios', '3', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (284, 'Usuarios', '4', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (285, 'Usuarios', '5', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (286, 'Usuarios', '6', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (287, 'Usuarios', '7', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (288, 'Usuarios', '8', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (289, 'Links', '1', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (290, 'Links', '2', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (291, 'Links', '3', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (292, 'Links', '4', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (293, 'Links', '5', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (294, 'Usuarios', '9', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (295, 'Links', '6', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (296, 'Links', '7', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (297, 'Links', '8', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (298, 'Links', '9', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (299, 'Links', '10', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (300, 'Usuarios', '10', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (301, 'Links', '11', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (302, 'Links', '12', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (303, 'Links', '13', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (304, 'Links', '14', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (305, 'Links', '15', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (306, 'Usuarios', '11', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (307, 'Links', '16', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (308, 'Links', '17', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (309, 'Links', '18', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (310, 'Links', '19', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (311, 'Links', '20', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (312, 'Usuarios', '12', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (313, 'Links', '21', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (314, 'Links', '22', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (315, 'Links', '23', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (316, 'Links', '24', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (317, 'Links', '25', 'Registro de Nuevo Link', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (318, 'Usuarios', '13', 'Registro de Nuevo Usuario', '2017-07-26', '12:28:49 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (319, '', '', 'Cerrada la Sesión', '2017-07-26', '12:31:33 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (320, '', '', 'Inicio de Sesion', '2017-07-26', '12:32:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (321, 'Usuarios', '15', 'Registro de nuevo Usuario', '2017-07-26', '12:34:45 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (322, '', '', 'Cerrada la Sesión', '2017-07-26', '12:34:55 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (323, '', '', 'Inicio de Sesion', '2017-07-26', '12:35:04 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (324, '', '', 'Cerrada la Sesión', '2017-07-26', '12:35:24 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (325, '', '', 'Inicio de Sesion', '2017-07-26', '12:36:34 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (326, 'RelPagos', '1', 'Actualización Pago al sistema', '2017-07-26', '12 :39:30 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (327, 'RelPagos', '1', 'Actualización Pago al sistema', '2017-07-26', '12 :39:42 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (328, '', '', 'Cerrada la Sesión', '2017-07-26', '12:42:54 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (329, '', '', 'Inicio de Sesion', '2017-07-26', '12:43:06 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (330, '', '', 'Cerrada la Sesión', '2017-07-26', '12:43:40 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (331, '', '', 'Inicio de Sesion', '2017-07-26', '12:43:49 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (332, '', '', 'Cerrada la Sesión', '2017-07-26', '01:09:22 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (333, '', '', 'Inicio de Sesion', '2017-07-26', '01:09:31 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (334, '', '', 'Cerrada la Sesión', '2017-07-26', '01:33:53 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (335, '', '', 'Inicio de Sesion', '2017-07-26', '01:40:36 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (336, 'Cuentas Bot', '1', 'Registro de Nueva Cuenta', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (337, 'Usuarios', '16', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (338, 'Usuarios', '17', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (339, 'Usuarios', '18', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (340, 'Usuarios', '19', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (341, 'Usuarios', '20', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (342, 'Usuarios', '21', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (343, 'Usuarios', '22', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (344, 'Links', '1', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (345, 'Links', '2', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (346, 'Links', '3', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (347, 'Links', '4', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (348, 'Links', '5', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (349, 'Usuarios', '23', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (350, 'Links', '6', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (351, 'Links', '7', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (352, 'Links', '8', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (353, 'Links', '9', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (354, 'Links', '10', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (355, 'Usuarios', '24', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (356, 'Links', '11', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (357, 'Links', '12', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (358, 'Links', '13', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (359, 'Links', '14', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (360, 'Links', '15', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (361, 'Usuarios', '25', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (362, 'Links', '16', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (363, 'Links', '17', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (364, 'Links', '18', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (365, 'Links', '19', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (366, 'Links', '20', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (367, 'Usuarios', '26', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (368, 'Links', '21', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (369, 'Links', '22', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (370, 'Links', '23', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (371, 'Links', '24', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (372, 'Links', '25', 'Registro de Nuevo Link', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (373, 'Usuarios', '27', 'Registro de Nuevo Usuario', '2017-07-26', '02:31:22 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (374, 'Cuentas Bot', '1', 'Registro de Nueva Cuenta', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (375, 'Usuarios', '2', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (376, 'Usuarios', '3', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (377, 'Usuarios', '4', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (378, 'Usuarios', '5', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (379, 'Usuarios', '6', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (380, 'Usuarios', '7', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (381, 'Usuarios', '8', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (382, 'Links', '1', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (383, 'Links', '2', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (384, 'Links', '3', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (385, 'Links', '4', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (386, 'Links', '5', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (387, 'Usuarios', '9', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (388, 'Links', '6', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (389, 'Links', '7', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (390, 'Links', '8', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (391, 'Links', '9', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (392, 'Links', '10', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (393, 'Usuarios', '10', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (394, 'Links', '11', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (395, 'Links', '12', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (396, 'Links', '13', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (397, 'Links', '14', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (398, 'Links', '15', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (399, 'Usuarios', '11', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (400, 'Links', '16', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (401, 'Links', '17', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (402, 'Links', '18', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (403, 'Links', '19', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (404, 'Links', '20', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (405, 'Usuarios', '12', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (406, 'Links', '21', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (407, 'Links', '22', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (408, 'Links', '23', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (409, 'Links', '24', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (410, 'Links', '25', 'Registro de Nuevo Link', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (411, 'Usuarios', '13', 'Registro de Nuevo Usuario', '2017-07-26', '02:33:30 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (412, '', '', 'Cerrada la Sesión', '2017-07-26', '02:36:10 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (413, '', '', 'Inicio de Sesion', '2017-07-26', '02:36:42 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (414, 'Usuarios', '14', 'Registro de nuevo Usuario', '2017-07-26', '02:37:39 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (415, '', '', 'Cerrada la Sesión', '2017-07-26', '02:37:50 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (416, '', '', 'Inicio de Sesion', '2017-07-26', '02:37:58 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (417, '', '', 'Cerrada la Sesión', '2017-07-26', '02:38:34 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (418, '', '', 'Inicio de Sesion', '2017-07-26', '02:39:05 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (419, 'RelPagos', '1', 'Actualización Pago al sistema', '2017-07-26', '03 :04:35 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (420, '', '', 'Cerrada la Sesión', '2017-07-26', '03:06:43 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (421, '', '', 'Inicio de Sesion', '2017-07-26', '03:06:51 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (422, 'ref_perfil', '13', 'Actualización de Perfil', '2017-07-26', '03:10:44 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (423, '', '', 'Cerrada la Sesión', '2017-07-26', '03:10:59 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (424, '', '', 'Inicio de Sesion', '2017-07-26', '03:11:05 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (425, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-07-26', '03:32:57 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (426, 'Rel Distribución', '2', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:34:40 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (427, 'Rel Distribución', '3', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:34:58 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (428, 'Rel Distribución', '4', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:35:04 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (429, 'Rel Distribución', '5', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:35:44 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (430, 'Rel Distribución', '6', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:35:51 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (431, 'Rel Distribución', '7', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:36:04 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (432, 'Rel Distribución', '8', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:36:19 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (433, 'Rel Distribución', '9', 'Nueva Pago de distribucion de capital', '2017-07-26', '03:36:30 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (434, '', '', 'Cerrada la Sesión', '2017-07-26', '03:37:47 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (435, '', '', 'Inicio de Sesion', '2017-07-26', '10:43:30 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (436, '', '', 'Cerrada la Sesión', '2017-07-26', '10:43:46 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (437, '', '', 'Inicio de Sesion', '2017-07-26', '10:43:58 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (438, '', '', 'Cerrada la Sesión', '2017-07-26', '10:44:32 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (439, '', '', 'Cerrada la Sesión', '2017-07-26', '10:45:34 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (440, '', '', 'Inicio de Sesion', '2017-07-26', '10:47:01 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (441, 'Cuentas Bot', '2', 'Registro de Nueva Cuenta', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (442, 'Links', '26', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (443, 'Links', '27', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (444, 'Links', '28', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (445, 'Links', '29', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (446, 'Links', '30', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (447, 'Links', '31', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (448, 'Links', '32', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (449, 'Links', '33', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (450, 'Links', '34', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (451, 'Links', '35', 'Registro de Nuevo Link', '2017-07-26', '10:47:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (452, 'Links', '36', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (453, 'Links', '37', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (454, 'Links', '38', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (455, 'Links', '39', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (456, 'Links', '40', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (457, 'Links', '41', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (458, 'Links', '42', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (459, 'Links', '43', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (460, 'Links', '44', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (461, 'Links', '45', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (462, 'Links', '46', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (463, 'Links', '47', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (464, 'Links', '48', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (465, 'Links', '49', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (466, 'Links', '50', 'Registro de Nuevo Link', '2017-07-26', '10:47:44 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (467, 'Cuentas Bot', '1', 'Registro de Nueva Cuenta', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (468, 'Usuarios', '2', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (469, 'Usuarios', '3', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (470, 'Usuarios', '4', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (471, 'Usuarios', '5', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (472, 'Usuarios', '6', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (473, 'Usuarios', '7', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (474, 'Usuarios', '8', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (475, 'Links', '51', 'Registro de Nuevo Link', '2017-07-26', '10:51:03 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (476, 'Links', '52', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (477, 'Links', '53', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (478, 'Links', '54', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (479, 'Links', '55', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (480, 'Usuarios', '9', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (481, 'Links', '56', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (482, 'Links', '57', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (483, 'Links', '58', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (484, 'Links', '59', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (485, 'Links', '60', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (486, 'Usuarios', '10', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (487, 'Links', '61', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (488, 'Links', '62', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (489, 'Links', '63', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (490, 'Links', '64', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (491, 'Links', '65', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (492, 'Usuarios', '11', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (493, 'Links', '66', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (494, 'Links', '67', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (495, 'Links', '68', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (496, 'Links', '69', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (497, 'Links', '70', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (498, 'Usuarios', '12', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (499, 'Links', '71', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (500, 'Links', '72', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (501, 'Links', '73', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (502, 'Links', '74', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (503, 'Links', '75', 'Registro de Nuevo Link', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (504, 'Usuarios', '13', 'Registro de Nuevo Usuario', '2017-07-26', '10:51:04 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (505, 'Cuentas Bot', '1', 'Registro de Nueva Cuenta', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (506, 'Usuarios', '2', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (507, 'Usuarios', '3', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (508, 'Usuarios', '4', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (509, 'Usuarios', '5', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (510, 'Usuarios', '6', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (511, 'Usuarios', '7', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (512, 'Usuarios', '8', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (513, 'Links', '1', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (514, 'Links', '2', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (515, 'Links', '3', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (516, 'Links', '4', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (517, 'Links', '5', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (518, 'Usuarios', '9', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (519, 'Links', '6', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (520, 'Links', '7', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (521, 'Links', '8', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (522, 'Links', '9', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (523, 'Links', '10', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (524, 'Usuarios', '10', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (525, 'Links', '11', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (526, 'Links', '12', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (527, 'Links', '13', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (528, 'Links', '14', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (529, 'Links', '15', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (530, 'Usuarios', '11', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (531, 'Links', '16', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (532, 'Links', '17', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (533, 'Links', '18', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (534, 'Links', '19', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (535, 'Links', '20', 'Registro de Nuevo Link', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (536, 'Usuarios', '12', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:11 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (537, 'Links', '21', 'Registro de Nuevo Link', '2017-07-26', '10:53:12 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (538, 'Links', '22', 'Registro de Nuevo Link', '2017-07-26', '10:53:12 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (539, 'Links', '23', 'Registro de Nuevo Link', '2017-07-26', '10:53:12 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (540, 'Links', '24', 'Registro de Nuevo Link', '2017-07-26', '10:53:12 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (541, 'Links', '25', 'Registro de Nuevo Link', '2017-07-26', '10:53:12 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (542, 'Usuarios', '13', 'Registro de Nuevo Usuario', '2017-07-26', '10:53:12 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (543, 'Usuarios', '14', 'Registro de nuevo Usuario', '2017-07-26', '10:54:25 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (544, '', '', 'Cerrada la Sesión', '2017-07-26', '10:54:34 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (545, '', '', 'Inicio de Sesion', '2017-07-26', '10:54:40 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (546, '', '', 'Cerrada la Sesión', '2017-07-26', '10:54:46 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (547, '', '', 'Inicio de Sesion', '2017-07-26', '10:55:37 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (548, 'RelPagos', '1', 'Actualización Pago al sistema', '2017-07-26', '10 :56:19 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (549, 'RelPagos', '1', 'Actualización Pago al sistema', '2017-07-26', '10 :57:04 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (550, '', '', 'Cerrada la Sesión', '2017-07-26', '10:57:24 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (551, '', '', 'Inicio de Sesion', '2017-07-26', '10:57:32 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (552, 'ref_perfil', '13', 'Actualización de Perfil', '2017-07-26', '10:57:41 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (553, '', '', 'Cerrada la Sesión', '2017-07-26', '10:58:13 am', 14);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (554, '', '', 'Inicio de Sesion', '2017-07-26', '10:58:22 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (555, 'Perfiles', '18993867', 'Edición de perfil de usuario: jsolorzano', '2017-07-26', '10:58:50 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (556, 'Rel Distribución', '2', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:16 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (557, 'Rel Distribución', '3', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:22 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (558, 'Rel Distribución', '4', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:26 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (559, 'Rel Distribución', '5', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:31 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (560, 'Rel Distribución', '6', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:36 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (561, 'Rel Distribución', '7', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:47 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (562, 'Rel Distribución', '8', 'Nueva Pago de distribucion de capital', '2017-07-26', '10:59:54 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (563, 'Rel Distribución', '9', 'Nueva Pago de distribucion de capital', '2017-07-26', '11:00:02 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (564, 'RelLinks', '15', 'Generacion de Links de invitación usuario:jsolorzano', '2017-07-26', '11:00:48 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (565, '', '', 'Inicio de Sesion', '2017-07-28', '04:02:32 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (566, 'Empresa', '1', 'Edición de la Empresa', '2017-07-28', '04:08:38 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (567, 'Monedero', '1', 'Registro de monedero', '2017-07-28', '04:14:00 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (568, 'Monedero', '1', 'Edición de monedero', '2017-07-28', '04:20:08 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (569, 'Asignacion Monto', '1', 'Edición de Asignacion de Monto', '2017-07-28', '04:41:13 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (570, 'Asignacion Monto', '1', 'Edición de Asignacion de Monto', '2017-07-28', '04:42:31 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (571, '', '', 'Cerrada la Sesión', '2017-07-28', '05:09:55 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (572, '', '', 'Inicio de Sesion', '2017-07-28', '05:11:14 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (573, '', '', 'Cerrada la Sesión', '2017-07-28', '05:37:19 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (574, '', '', 'Inicio de Sesion', '2017-07-28', '05:37:24 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (575, '', '', 'Inicio de Sesion', '2017-07-28', '05:38:05 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (576, '', '', 'Cerrada la Sesión', '2017-07-28', '05:43:36 am', 15);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (577, '', '', 'Inicio de Sesion', '2017-07-28', '05:43:43 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (578, '', '', 'Inicio de Sesion', '2017-07-28', '05:43:57 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (579, 'Comisión Retiro', '1', 'Edición de Comisión de Retiro: 8%', '2017-07-28', '05:46:19 am', 1);
INSERT INTO auditoria (id, tabla, codigo, accion, fecha, hora, usuario) VALUES (580, 'Comisión Retiro', '1', 'Edición de Comisión de Retiro: 7%', '2017-07-28', '05:53:22 am', 1);


--
-- TOC entry 2152 (class 0 OID 0)
-- Dependencies: 179
-- Name: auditoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('auditoria_id_seq', 580, true);


--
-- TOC entry 2153 (class 0 OID 0)
-- Dependencies: 180
-- Name: claves_sistema_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('claves_sistema_id_seq', 1, false);


--
-- TOC entry 2096 (class 0 OID 28298)
-- Dependencies: 182
-- Data for Name: conf_grupo_user; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (1, 1, 'Administrador', true, NULL, NULL, NULL, NULL);
INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (2, 2, 'OPERADOR', true, 2, NULL, NULL, NULL);
INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (3, 3, 'BÁSICO', true, 2, NULL, NULL, NULL);
INSERT INTO conf_grupo_user (id, codigo, name, activo, user_create, date_create, user_update, date_update) VALUES (4, 4, 'BOTS', true, 1, NULL, NULL, NULL);


--
-- TOC entry 2154 (class 0 OID 0)
-- Dependencies: 183
-- Name: conf_grupo_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('conf_grupo_user_id_seq', 1, false);


--
-- TOC entry 2098 (class 0 OID 28319)
-- Dependencies: 184
-- Data for Name: conf_tipos_monedas; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (1, 1, 'BITCOINS', true, 'Bit       ');
INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (2, 2, 'BOLÍVARES', true, 'BS        ');
INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (3, 3, 'DOLARES', true, '$         ');
INSERT INTO conf_tipos_monedas (id, codigo, descripcion, activo, abreviatura) VALUES (4, 4, 'EUROS', true, '€         ');


--
-- TOC entry 2155 (class 0 OID 0)
-- Dependencies: 185
-- Name: conf_tipos_monedas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('conf_tipos_monedas_id_seq', 1, false);


--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 187
-- Name: ref_links_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_links_id_seq', 1, false);


--
-- TOC entry 2102 (class 0 OID 28329)
-- Dependencies: 188
-- Data for Name: ref_perfil; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (6, 6, 7, 17578500, 1100, 4, 6, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (7, 7, 8, 17578500, 1100, 4, 7, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (8, 8, 9, 17578500, 1200, 4, 8, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (1, 1, 2, 17578500, 1000, 4, 1, 1, NULL, NULL, NULL, NULL, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (9, 9, 10, 17578500, 1000, 4, 8, 1, NULL, NULL, NULL, NULL, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (10, 10, 11, 17578500, 1000, 4, 8, 1, NULL, NULL, NULL, NULL, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (11, 11, 12, 17578500, 1000, 4, 8, 1, NULL, NULL, NULL, NULL, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (12, 12, 13, 17578500, 1000, 4, 8, 1, NULL, NULL, NULL, NULL, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (2, 2, 3, 17578500, 1200, 4, 2, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (3, 3, 4, 17578500, 1100, 4, 3, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (4, 4, 5, 17578500, 1100, 4, 4, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (5, 5, 6, 17578500, 1100, 4, 5, 1, NULL, NULL, NULL, 1, '2017-07-26', NULL, 1000, 50, 10, NULL);
INSERT INTO ref_perfil (id, codigo, usuario_id, maximo, disponible, estatus, referido_id, t_moneda_id, tipo_cuenta_id, num_cuenta_usu, banco_usu_id, cant_ref, fecha, nivel, monto_pago, monto_retiro_minimo, cargo_mora, dir_monedero) VALUES (13, 13, 15, 17578500, 0, 4, 9, 1, NULL, NULL, NULL, NULL, '2017-07-26', 1, 1000, 50, 10, NULL);


--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 189
-- Name: ref_perfil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_perfil_id_seq', 1, false);


--
-- TOC entry 2104 (class 0 OID 28334)
-- Dependencies: 190
-- Data for Name: ref_rel_distribucion; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (1, 1, 15, 99, '2017-07-26          ', 100);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (2, 2, 15, 3, '2017-07-26          ', 200);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (3, 3, 15, 4, '2017-07-26          ', 100);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (4, 4, 15, 5, '2017-07-26          ', 100);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (5, 5, 15, 6, '2017-07-26          ', 100);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (6, 6, 15, 7, '2017-07-26          ', 100);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (7, 7, 15, 8, '2017-07-26          ', 100);
INSERT INTO ref_rel_distribucion (id, codigo, usuario_id, referido_id, fecha, monto) VALUES (8, 8, 15, 9, '2017-07-26          ', 200);


--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 191
-- Name: ref_rel_distribucion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_distribucion_id_seq', 8, true);


--
-- TOC entry 2100 (class 0 OID 28324)
-- Dependencies: 186
-- Data for Name: ref_rel_links; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (2, 2, 9, 'http://localhost/club_bitcoin/index.php?codigo=9&link=2', 1, NULL, 2, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (3, 3, 9, 'http://localhost/club_bitcoin/index.php?codigo=9&link=3', 1, NULL, 3, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (4, 4, 9, 'http://localhost/club_bitcoin/index.php?codigo=9&link=4', 1, NULL, 4, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (5, 5, 9, 'http://localhost/club_bitcoin/index.php?codigo=9&link=5', 1, NULL, 5, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (6, 6, 10, 'http://localhost/club_bitcoin/index.php?codigo=10&link=1', 1, NULL, 1, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (7, 7, 10, 'http://localhost/club_bitcoin/index.php?codigo=10&link=2', 1, NULL, 2, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (8, 8, 10, 'http://localhost/club_bitcoin/index.php?codigo=10&link=3', 1, NULL, 3, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (9, 9, 10, 'http://localhost/club_bitcoin/index.php?codigo=10&link=4', 1, NULL, 4, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (10, 10, 10, 'http://localhost/club_bitcoin/index.php?codigo=10&link=5', 1, NULL, 5, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (11, 11, 11, 'http://localhost/club_bitcoin/index.php?codigo=11&link=1', 1, NULL, 1, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (12, 12, 11, 'http://localhost/club_bitcoin/index.php?codigo=11&link=2', 1, NULL, 2, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (13, 13, 11, 'http://localhost/club_bitcoin/index.php?codigo=11&link=3', 1, NULL, 3, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (14, 14, 11, 'http://localhost/club_bitcoin/index.php?codigo=11&link=4', 1, NULL, 4, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (15, 15, 11, 'http://localhost/club_bitcoin/index.php?codigo=11&link=5', 1, NULL, 5, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (16, 16, 12, 'http://localhost/club_bitcoin/index.php?codigo=12&link=1', 1, NULL, 1, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (17, 17, 12, 'http://localhost/club_bitcoin/index.php?codigo=12&link=2', 1, NULL, 2, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (18, 18, 12, 'http://localhost/club_bitcoin/index.php?codigo=12&link=3', 1, NULL, 3, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (19, 19, 12, 'http://localhost/club_bitcoin/index.php?codigo=12&link=4', 1, NULL, 4, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (20, 20, 12, 'http://localhost/club_bitcoin/index.php?codigo=12&link=5', 1, NULL, 5, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (21, 21, 13, 'http://localhost/club_bitcoin/index.php?codigo=13&link=1', 1, NULL, 1, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (22, 22, 13, 'http://localhost/club_bitcoin/index.php?codigo=13&link=2', 1, NULL, 2, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (23, 23, 13, 'http://localhost/club_bitcoin/index.php?codigo=13&link=3', 1, NULL, 3, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (24, 24, 13, 'http://localhost/club_bitcoin/index.php?codigo=13&link=4', 1, NULL, 4, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (25, 25, 13, 'http://localhost/club_bitcoin/index.php?codigo=13&link=5', 1, NULL, 5, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (1, 1, 9, 'http://localhost/club_bitcoin/index.php?codigo=9&link=1', 2, 15, 1, '2017-07-26          ', NULL, 1);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (26, 26, 15, 'http://localhost/club_bitcoin/index.php?codigo=15&link=1', 1, NULL, 1, '2017-07-26          ', NULL, NULL);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (27, 27, 15, 'http://localhost/club_bitcoin/index.php?codigo=15&link=2', 1, NULL, 2, '2017-07-26          ', NULL, NULL);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (28, 28, 15, 'http://localhost/club_bitcoin/index.php?codigo=15&link=3', 1, NULL, 3, '2017-07-26          ', NULL, NULL);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (29, 29, 15, 'http://localhost/club_bitcoin/index.php?codigo=15&link=4', 1, NULL, 4, '2017-07-26          ', NULL, NULL);
INSERT INTO ref_rel_links (id, codigo, usuario_id, links, estatus, referido_id, num_link, fecha, verif_pago, bot_id) VALUES (30, 30, 15, 'http://localhost/club_bitcoin/index.php?codigo=15&link=5', 1, NULL, 5, '2017-07-26          ', NULL, NULL);


--
-- TOC entry 2106 (class 0 OID 28339)
-- Dependencies: 192
-- Data for Name: ref_rel_pagos; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2107 (class 0 OID 28342)
-- Dependencies: 193
-- Data for Name: ref_rel_pagos_bitcoins; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO ref_rel_pagos_bitcoins (id, codigo, usuario_id, monto, estatus, dir_monedero, fecha_pago, operador_id, fecha_verificacion, perfil_id) VALUES (1, 1, 15, 1000, 2, 'AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4', '2017-07-13', 14, '2017-07-26', 13);


--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 194
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_pagos_bitcoins_id_seq', 1, false);


--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 195
-- Name: ref_rel_pagos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_pagos_id_seq', 1, false);


--
-- TOC entry 2110 (class 0 OID 28349)
-- Dependencies: 196
-- Data for Name: ref_rel_retiros; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 197
-- Name: ref_rel_retiros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_retiros_id_seq', 1, false);


--
-- TOC entry 2112 (class 0 OID 28354)
-- Dependencies: 198
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (1, 1, 'admin', 'pbkdf2_sha256$12000$8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 12345678, 'ADMIN', 'ADMIN', 'admin@gmail.com', '1', NULL, '04161073358', true, NULL, NULL, NULL, NULL);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (2, 2, 'botBit1', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'MARÍA', 'GÓMEZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (3, 3, 'botBit2', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'ANA', 'JIMÉNEZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (4, 4, 'botBit3', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'JUAN', 'LOPEZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (5, 5, 'botBit4', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'PEDRO', 'PEREZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (6, 6, 'botBit5', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'CARLOS', 'JIMÉNEZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (7, 7, 'botBit6', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'DOUGLAS', 'SANTANA', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (8, 8, 'botBit7', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'ARIANA', 'GONZÁLEZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (9, 9, 'botBit8', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'FRANK', 'COLMENARES', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (10, 10, 'botBit9', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'PAOLA', 'ROJAS', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (11, 11, 'botBit10', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'CARMEN', 'FRANCO', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (12, 12, 'botBit11', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'JULIO', 'PIRELA', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:11-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (13, 13, 'botBit12', 'pbkdf2_sha256$12000$8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, 'LUIS', 'MENDEZ', NULL, '4', NULL, NULL, true, NULL, '2017-07-26 07:53:12-07', NULL, 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (14, 14, 'operador', 'pbkdf2_sha256$12000$a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 12345678, 'OPERADOR', 'OPERADOR', 'OPERADOR@GMAIL.COM', '2', NULL, '04141515614', true, '', '2017-07-26 07:54:24-07', '2017-07-26 07:54:24-07', 1);
INSERT INTO usuarios (id, codigo, username, password, cedula, first_name, last_name, email, tipo_usuario, cargo, telefono, estatus, picture, fecha_create, fecha_update, user_create_id) VALUES (15, 15, 'jsolorzano', 'pbkdf2_sha256$12000$a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 18993867, 'JOSÉ', 'SOLORZANO', 'josesolorzano@gmail.com', '3', NULL, '(0416) 107-3358', true, NULL, '2017-07-26 07:55:29-07', '2017-07-26 07:55:29-07', NULL);


--
-- TOC entry 2113 (class 0 OID 28360)
-- Dependencies: 199
-- Data for Name: usuarios_desvinculados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 200
-- Name: usuarios_desvinculados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_desvinculados_id_seq', 1, false);


--
-- TOC entry 2115 (class 0 OID 28365)
-- Dependencies: 201
-- Data for Name: usuarios_eliminados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 202
-- Name: usuarios_eliminados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_eliminados_id_seq', 1, false);


--
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 203
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_id_seq', 19, true);


--
-- TOC entry 2118 (class 0 OID 28372)
-- Dependencies: 204
-- Data for Name: usuarios_revinculados; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 205
-- Name: usuarios_revinculados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('usuarios_revinculados_id_seq', 1, false);


--
-- TOC entry 1951 (class 2606 OID 28400)
-- Name: asig_monto_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY adm_asignacion_montos
    ADD CONSTRAINT asig_monto_key PRIMARY KEY (id);


--
-- TOC entry 1955 (class 2606 OID 28402)
-- Name: auditoria_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT auditoria_key PRIMARY KEY (id);


--
-- TOC entry 1953 (class 2606 OID 28404)
-- Name: bots_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY adm_cuentas_bot
    ADD CONSTRAINT bots_key PRIMARY KEY (id);


--
-- TOC entry 1957 (class 2606 OID 28408)
-- Name: grupos_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY conf_grupo_user
    ADD CONSTRAINT grupos_key PRIMARY KEY (id);


--
-- TOC entry 1973 (class 2606 OID 28410)
-- Name: id_desv_primary_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios_desvinculados
    ADD CONSTRAINT id_desv_primary_key PRIMARY KEY (id);


--
-- TOC entry 1975 (class 2606 OID 28412)
-- Name: id_primary_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios_eliminados
    ADD CONSTRAINT id_primary_key PRIMARY KEY (id);


--
-- TOC entry 1977 (class 2606 OID 28414)
-- Name: id_rev_primary_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios_revinculados
    ADD CONSTRAINT id_rev_primary_key PRIMARY KEY (id);


--
-- TOC entry 1961 (class 2606 OID 28416)
-- Name: link_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_links
    ADD CONSTRAINT link_key PRIMARY KEY (id);


--
-- TOC entry 1967 (class 2606 OID 28418)
-- Name: pagos_bit_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_pagos_bitcoins
    ADD CONSTRAINT pagos_bit_key PRIMARY KEY (id);


--
-- TOC entry 1965 (class 2606 OID 28420)
-- Name: pagos_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_pagos
    ADD CONSTRAINT pagos_key PRIMARY KEY (id);


--
-- TOC entry 1963 (class 2606 OID 28422)
-- Name: prefil_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_perfil
    ADD CONSTRAINT prefil_key PRIMARY KEY (id);


--
-- TOC entry 1969 (class 2606 OID 28424)
-- Name: ref_rel_retiros_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_retiros
    ADD CONSTRAINT ref_rel_retiros_key PRIMARY KEY (id);


--
-- TOC entry 1959 (class 2606 OID 28428)
-- Name: tipo_moneda_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY conf_tipos_monedas
    ADD CONSTRAINT tipo_moneda_key PRIMARY KEY (id);


--
-- TOC entry 1971 (class 2606 OID 28430)
-- Name: usuarios_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_key PRIMARY KEY (id);


-- Completed on 2017-07-27 23:56:00

--
-- PostgreSQL database dump complete
--

