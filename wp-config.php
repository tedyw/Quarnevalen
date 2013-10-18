<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil innehåller följande konfigurationer: Inställningar för MySQL,
 * Tabellprefix, Säkerhetsnycklar, WordPress-språk, och ABSPATH.
 * Mer information på {@link http://codex.wordpress.org/Editing_wp-config.php 
 * Editing wp-config.php}. MySQL-uppgifter får du från ditt webbhotell.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i värdena.
 *
 * @package WordPress
 */

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define('DB_NAME', 'quarnevalen');

/** MySQL-databasens användarnamn */
define('DB_USER', 'root');

/** MySQL-databasens lösenord */
define('DB_PASSWORD', 'root');

/** MySQL-server */
define('DB_HOST', 'localhost');

/** Teckenkodning för tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
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
 * Tabellprefix för WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokstäver och understreck!
 */
$table_prefix  = 'wp_';

/**
 * WordPress-språk, förinställt för svenska.
 *
 * Du kan ändra detta för att ändra språk för WordPress.  En motsvarande .mo-fil
 * för det valda språket måste finnas i wp-content/languages. Exempel, lägg till
 * sv_SE.mo i wp-content/languages och ange WPLANG till 'sv_SE' för att få sidan
 * på svenska.
 */
define('WPLANG', 'sv_SE');

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det är rekommderat att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera här! Blogga på. */

/** Absoluta sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');