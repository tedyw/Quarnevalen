<?php
/**
 * Baskonfiguration f�r WordPress.
 *
 * Denna fil inneh�ller f�ljande konfigurationer: Inst�llningar f�r MySQL,
 * Tabellprefix, S�kerhetsnycklar, WordPress-spr�k, och ABSPATH.
 * Mer information p� {@link http://codex.wordpress.org/Editing_wp-config.php 
 * Editing wp-config.php}. MySQL-uppgifter f�r du fr�n ditt webbhotell.
 *
 * Denna fil anv�nds av wp-config.php-genereringsskript under installationen.
 * Du beh�ver inte anv�nda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i v�rdena.
 *
 * @package WordPress
 */

// ** MySQL-inst�llningar - MySQL-uppgifter f�r du fr�n ditt webbhotell ** //
/** Namnet p� databasen du vill anv�nda f�r WordPress */
define('DB_NAME', 'quarnevalen');

/** MySQL-databasens anv�ndarnamn */
define('DB_USER', 'root');

/** MySQL-databasens l�senord */
define('DB_PASSWORD', 'root');

/** MySQL-server */
define('DB_HOST', 'localhost');

/** Teckenkodning f�r tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp f�r databasen. �ndra inte om du �r os�ker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * �ndra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan n�r som helst �ndra dessa nycklar f�r att g�ra aktiva cookies obrukbara, vilket tvingar alla anv�ndare att logga in p� nytt.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'D<n<U|n?s}KNGS^UsEoFS0x;`_W%`_u<[RiJVrZ]2ubd3b-`]~#^I/W4+BFv%+Kk');
define('SECURE_AUTH_KEY',  '8-`x_dATun{(sos=uBI9;p/^;dIO|T@]~Bf=]b]W xL*vq4=Mlj8IXEb} |kw@xQ');
define('LOGGED_IN_KEY',    'g~t^k4!h^QXqgJ()B6( G>RExu %|ktBsafPPRsgPa}$8~QxdA&#_8jW0.=Mx$#1');
define('NONCE_KEY',        '[/O7tIcy(SuVU]L>zzmf,ZY/nJ3z:3MNsN,%Y_HWag::9K@BPL2`UxYNImeot_oO');
define('AUTH_SALT',        'iyj^Qy1!<!1XMX_@`&tL0Kh)gZ`(PV7np)wx%RlWyN4qx$@mm~{Ej9ZBnL[yO.n2');
define('SECURE_AUTH_SALT', 'KI<yY?]?;foJdIpwl=M-xA<bH/R,KIH>kEA>THR!FS(>xbJr0b5Pt<m>/C>).cO~');
define('LOGGED_IN_SALT',   '=6}V8?w7gd5TJD`T#U]vd@>5jO#(yaPPO~H%]t4*Ti416#ud`n6-k*>L2Cg^9h>0');
define('NONCE_SALT',       'lsCl.|_TA?ghDeOF(_JeXf>Il-6~ShVKgA[o&r; Y9FnU>hV!}wXpk~|/+B#=[3t');

/**#@-*/

/**
 * Tabellprefix f�r WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokst�ver och understreck!
 */
$table_prefix  = 'wp_';

/**
 * WordPress-spr�k, f�rinst�llt f�r svenska.
 *
 * Du kan �ndra detta f�r att �ndra spr�k f�r WordPress.  En motsvarande .mo-fil
 * f�r det valda spr�ket m�ste finnas i wp-content/languages. Exempel, l�gg till
 * sv_SE.mo i wp-content/languages och ange WPLANG till 'sv_SE' f�r att f� sidan
 * p� svenska.
 */
define('WPLANG', 'sv_SE');

/** 
 * F�r utvecklare: WordPress fels�kningsl�ge. 
 * 
 * �ndra detta till true f�r att aktivera meddelanden under utveckling. 
 * Det �r rekommderat att man som till�ggsskapare och temaskapare anv�nder WP_DEBUG 
 * i sin utvecklingsmilj�. 
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera h�r! Blogga p�. */

/** Absoluta s�kv�g till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-v�rden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');