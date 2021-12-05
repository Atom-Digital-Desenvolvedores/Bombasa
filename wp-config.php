<?php
define('WP_AUTO_UPDATE_CORE', 'minor');

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'bombasac_website2020' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'bombasac_site20' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '6m0Db9ZPqKu3' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '>J8F o#S10b&{RmnLc)n{0xt ;#fJ9Le3&&:)<w;Tcj~8e{ksBj,cSD!F{Jl@=].' );
define( 'SECURE_AUTH_KEY',  '65#ooCJZ5|_j^Y{s**P5{ /jCglb{sQU=[zu_dnsM/*;m5 inxR[@{!FbMs*bcv*' );
define( 'LOGGED_IN_KEY',    'wwSh]XcuRt{eO/0s_B*gi5.4Mz|,=Y:[#9Zf[T/$:Z/**0(GCZaxsRTHXM>Nw6nv' );
define( 'NONCE_KEY',        'kJ}^<QRlLe_`CNw+h@yEr)f*K|o }{j)Mx0C$96J64YIbIG)#rP:96&Yrt2qSX=0' );
define( 'AUTH_SALT',        'Vrbj?dekvgc.,!Tn]w.c0!0&oAFZF,fnwE~C4!<?-6d:xwaVP [ *Z`m]/q5p<N.' );
define( 'SECURE_AUTH_SALT', 'AboeCukb-QOi.uH5x8jXSS2tq0I+43$0. gtX/CAi(8*+^Wao?c6JJwQCM^!YM*I' );
define( 'LOGGED_IN_SALT',   'DT*YH`G,U}qL4*IZ(F#i_Jko6B9e[W_8~1I*&uG-Iao9k>TaO:m;Xd.7w~FZaELj' );
define( 'NONCE_SALT',       '!syT[N&Q~Y_%6ilot/e9 C+Z&f|0s}si)ALc:a]-CQ6@fzyOVyvs)NTaBVjs*#{<' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'vdp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
