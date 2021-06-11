<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 14/06/2017
 * Time: 21:14
 */


class brozzmeDbPSettings
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_pages'), 110);
        add_action('admin_init', array($this, 'settings_fields'));

    }

    public function add_admin_pages()
    {
        add_submenu_page(BFSL_PLUGINS_DEV_GROUPE_ID,
            __('DB PREFIX', B7EDBP_TEXT_DOMAIN),
            __('DB PREFIX', B7EDBP_TEXT_DOMAIN),
            'manage_options',
            B7EDBP_SETTINGS_SLUG,
            array($this, 'settings_page')
        );

        add_submenu_page('tools.php',
            __('DB PREFIX', B7EDBP_TEXT_DOMAIN),
            __('DB PREFIX', B7EDBP_TEXT_DOMAIN),
            'manage_options',
            B7EDBP_SETTINGS_SLUG,
            array($this, 'settings_page')
        );

    }

    public function settings_page(){

        global $wpdb;

        if(($_POST['dbprefix_hidden'] == 'Y' && isset($_POST['dbprefix_hidden'])) && (isset($_POST['Submit']) && trim($_POST['Submit'])==__('Change DB Prefix', B7EDBP_TEXT_DOMAIN ))) {

            $old_dbprefix = $_POST['dbprefix_old_dbprefix'];
            update_option('dbprefix_old_dbprefix', $old_dbprefix);

            $dbprefix_new = $_POST['dbprefix_new'];
            update_option('dbprefix_new', $dbprefix_new);

            $wpdb =& $GLOBALS['wpdb'];

            $new_prefix = preg_replace("/[^0-9a-zA-Z_]/", "", $dbprefix_new);

            $bprefix_Message = '';

            if($_POST['dbprefix_new'] =='' || strlen($_POST['dbprefix_new']) < 2 )
            {
                $bprefix_Message .= __('Please provide a proper table prefix.', B7EDBP_TEXT_DOMAIN);
            }
            else if ($new_prefix == $old_dbprefix) {
                $bprefix_Message .= __('No change! Please provide a new table prefix.', B7EDBP_TEXT_DOMAIN);
            }
            else if (strlen($new_prefix) < strlen($dbprefix_new)){
                $bprefix_Message .= __('You have used some characters disallowed for the table prefix. please use another prefix', B7EDBP_TEXT_DOMAIN) .' <b>'. $dbprefix_new .'</b>';
            }
            else
            {
                $tables = brozzme_db_prefix_core::dbprefix_getTablesToAlter();
                if (empty($tables))
                {
                    $bprefix_Message .= brozzme_db_prefix_core::dbprefix_eInfo(__('There are no tables to rename!', B7EDBP_TEXT_DOMAIN));
                }
                else
                {
                    $result = brozzme_db_prefix_core::dbprefix_renameTables($tables, $old_dbprefix, $dbprefix_new);
                    // check for errors
                    if (!empty($result))
                    {
                        $bprefix_Message .= __('All tables have been successfully updated with prefix', B7EDBP_TEXT_DOMAIN) .' <b>'.$dbprefix_new.'</b> !<br/>';
                        // try to rename the fields
                        $bprefix_Message .= brozzme_db_prefix_core::dbprefix_renameDbFields($old_dbprefix, $dbprefix_new);

                        $dbprefix_wpConfigFile = $this->get_wp_config_file();

                        if (brozzme_db_prefix_core::dbprefix_updateWpConfigTablePrefix($dbprefix_wpConfigFile, $old_dbprefix, $dbprefix_new))
                        {
                            $bprefix_Message .= __('The wp-config file has been successfully updated with prefix', B7EDBP_TEXT_DOMAIN) . ' <b>'.$dbprefix_new.'</b>!';
                        }
                        else {
                            $bprefix_Message .= __('The wp-config file could not be updated! You have to manually update the table_prefix variable to the one you have specified:', B7EDBP_TEXT_DOMAIN). ' '.$dbprefix_new;
                        }
                    }// End if tables successfully renamed
                    else {
                        $bprefix_Message .= __('An error has occurred and the tables could not be updated!', B7EDBP_TEXT_DOMAIN);
                    }
                    $_POST['dbprefix_hidden'] = 'n';

                   // header("location:".admin_url() . '/tools.php?page=' . $_GET['page']);
                    // End if there are tables to rename

                    $new_updated_prefix = get_option('dbprefix_new');
                }

                ?>
            <?php }
        } else {
            //Normal page display
            $dbhost = get_option('dbprefix_dbhost');
            $dbname = get_option('dbprefix_dbname');
            $dbuser = get_option('dbprefix_dbuser');
            $dbpwd = get_option('dbprefix_dbpwd');
            $dbprefix_exist = get_option('dbprefix_prefix_exist');
            $dbprefix_new = get_option('dbprefix_new');
        }
        if($new_updated_prefix != null && $wpdb->prefix != $new_updated_prefix){
            $input_prefix = $new_updated_prefix;
        }
        else{
            $input_prefix = $wpdb->prefix;
        }
        ?>
        <div class="wrap">
            <h2>Brozzme DB PREFIX</h2>

            <?php

            $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_settings';
            ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo B7EDBP_SETTINGS_SLUG;?>&tab=general_settings" class="nav-tab <?php echo $active_tab == 'general_settings' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Change DB Prefix', B7EDBP_TEXT_DOMAIN );?></a>
                <a href="?page=<?php echo B7EDBP_SETTINGS_SLUG;?>&tab=help_options" class="nav-tab <?php echo $active_tab == 'help_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Help', B7EDBP_TEXT_DOMAIN );?></a>
                <a href="admin.php?page=brozzme-plugins" class="nav-tab <?php echo $active_tab == 'brozzme' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Brozzme', B7EDBP_TEXT_DOMAIN );?></a>

            </h2>

            <?php if($active_tab == 'help_options'){

                $this->_help_tab();

            }
            elseif($active_tab == 'brozzme'){

            }
            else{
               ?>
                <form id="dbprefix_form" name="dbprefix_form" method="post" action="" >
                <input type="hidden" name="dbprefix_hidden" value="Y">
                <div id="cdtp" class="brozzme-info postbox">
                    <h3 class="hndle" style="cursor: default;"><span><?php _e('Database Prefix Settings', B7EDBP_TEXT_DOMAIN);?></span></h3>
                <div class="inside">
                    <div class="cdp">
                        <h4 style="margin-top: 15px;"><?php _e('Before execute this plugin:', B7EDBP_TEXT_DOMAIN); ?></h4>
                        <ul class="cdp-data" style="margin-top: 20px;">
                            <li><?php _e('Make sure your <code>wp-config.php</code> file is <strong>writable</strong>.', B7EDBP_TEXT_DOMAIN);?></li>
                            <li><?php _e('And check the database has <strong>ALTER</strong> rights.', B7EDBP_TEXT_DOMAIN);?></li>
                        </ul>
                    </div><!-- cdp div -->
                    <div class="success">
                        <?php echo $bprefix_Message;?>
                    </div><!-- success div -->
                    <?php if($_POST['dbprefix_hidden'] == 'Y') { ?>
                        <div class="updated">
                            <p><strong><?php _e('Options saved.' ); ?></strong></p>
                        </div><!-- updated div -->
                    <?php } ?>
                    <div class="cdp-container">
                        <label for="dbprefix_old_dbprefix" class="label01">
                                <span class="ttl02"><?php _e('Existing Prefix: ', B7EDBP_TEXT_DOMAIN );?>
                                    <span class="required">*</span></span>
                            <input type="text" disabled name="dbprefix_old_dbprefix_show" id="dbprefix_old_dbprefix_show" value="<?php echo $input_prefix; ?>" size="20" required>
                            <input type="hidden" name="dbprefix_old_dbprefix" id="dbprefix_old_dbprefix" value="<?php echo $input_prefix; ?>" size="20" >
                            <?php _e(' ex: wp_', B7EDBP_TEXT_DOMAIN ); ?><span class="error"></span>
                        </label><br/>
                        <label for="dbprefix_new" class="label01"> <span class="ttl02"><?php _e('New Prefix: ', B7EDBP_TEXT_DOMAIN ); ?>
                                <span class="required">*</span></span>
                            <input type="text" name="dbprefix_new" value="<?php echo esc_html($this->keygen());?>" size="20" id="dbprefix_new" required>
                            <?php _e(' ex: uniquekey_', B7EDBP_TEXT_DOMAIN ); ?>
                        </label>
                        <p class="margin-top:10px"><?php _e('<b>Allowed characters:</b> all latin alphanumeric as well as the <strong>_</strong> (underscore).', B7EDBP_TEXT_DOMAIN);?></p>
                        <p class="submit">
                            <input type="submit" name="Submit" class="button button-primary" value="<?php _e('Change DB Prefix', B7EDBP_TEXT_DOMAIN ); ?>" />
                        </p></div><!-- container div -->
                </div><!-- inside div -->
                </div><!-- postbox div -->
                </form>

                </div>
                <?php
            }?>

            <?php
        
    }

    public function keygen($length=4)
    {

        $length = rand(3,6);
        $key = '';
        list($usec, $sec) = explode(' ', microtime());
        mt_srand((float) $sec + ((float) $usec * 100000));

        $inputs = array_merge(range('z','a'),range(0,9));

        for($i=0; $i<$length; $i++)
        {
            $key .= $inputs{mt_rand(0,37)};
        }

        if(strlen($key)< 3){
            $add = array_rand(range('z','a'));
            $key = $key.$add;
        }
        return $key .'_';
    }

    public function get_wp_config_file() {
        if (file_exists(ABSPATH . 'wp-config.php')) {
            return ABSPATH . 'wp-config.php';
        }

        return dirname(ABSPATH) . '/wp-config.php';
    }

    public function settings_fields(){


    }

    public function _help_tab(){
        ?>

        <h2><?php _e('FAQ & HELP', B7EDBP_TEXT_DOMAIN);?></h2>

        <p><b><?php _e('Why do I need to change the WordPress database prefix ?', B7EDBP_TEXT_DOMAIN);?></b></p>
          <blockquote><?php _e('WordPress Database is like the heart for your WordPress site, as the database runs for every single information store, you need to protect it against hackers and spammers that could run automated code for SQL injections.
Many people forget to change the database prefix in the install wizard. This makes it easier for hackers to plan a mass attack by targeting the default prefix wp_. 
To avoid them, you can protect your database by changing the database prefix which is really easy with Brozzme DB Prefix. It takes a few seconds to change the prefix.', B7EDBP_TEXT_DOMAIN);?></blockquote>
        <p><b><?php _e('What do I need to verify before changes ?', B7EDBP_TEXT_DOMAIN);?></b></p>
        <h3><?php _e('MAKE SURE YOU HAVE A DATABASE BACKUP BEFORE USING THIS TOOL.', B7EDBP_TEXT_DOMAIN);?></h3>
        <blockquote><?php _e('You just need to verify: ', B7EDBP_TEXT_DOMAIN);?>
        <ul><li>- <?php _e('wp-config.php is writable on your server.', B7EDBP_TEXT_DOMAIN);?></li>
            <li>- <?php _e('that mySQL ALTER rights are enable.', B7EDBP_TEXT_DOMAIN);?></li>
            </ul>
        </blockquote>
        <p><b><?php _e('What can I do if the process fails ?', B7EDBP_TEXT_DOMAIN);?></b></p>
        <blockquote><?php _e('Depending on where the fail occurs: ', B7EDBP_TEXT_DOMAIN);?>
            <ul><li><?php _e('Compare prefix in the wp-config.php and in phpmyAdmin, depending on the the situation, ', B7EDBP_TEXT_DOMAIN);?></li>
                <li>- <?php _e('change manually $table_prefix value in wp-config.php.', B7EDBP_TEXT_DOMAIN);?></li>
                <li>- <?php _e('suppress all tables and import the backup in phpmyAdmin.', B7EDBP_TEXT_DOMAIN);?></li>
              <li><b><?php _e('Verify all the pre-requisite point in the previous question before processing once again.', B7EDBP_TEXT_DOMAIN);?></b></li>
            </ul></blockquote>
        <p><b><?php _e('Why can I not do it manually?', B7EDBP_TEXT_DOMAIN);?></b></p>
        <blockquote><?php _e('Of course you can, but there\'s many occurences to modify to make it works. Not only the tables name need to be modify.', B7EDBP_TEXT_DOMAIN);?>
            <ul><li><?php _e('Here is the exhaustive list of what to change, ', B7EDBP_TEXT_DOMAIN);?></li>
                <li>- <?php _e('Tables names,', B7EDBP_TEXT_DOMAIN);?></li>
                <li>- <?php _e('table options: {old_prefix}user_roles option name,', B7EDBP_TEXT_DOMAIN);?></li>
                <li><?php _e('table usermeta, for each registered user, {old_prefix}capabilities and {old_prefix}user_level, option names', B7EDBP_TEXT_DOMAIN);?></li>
                <li><?php _e('if exists you\'ll need to also modify {old_prefix}dashboard_quick_press_last_post_id option name', B7EDBP_TEXT_DOMAIN);?></li>
                <li><?php _e('', B7EDBP_TEXT_DOMAIN);?></li>
            </ul></blockquote>
        <p><b><?php _e('I can\'t delete, edit anymore using phpmyAdmin with MAMP...', B7EDBP_TEXT_DOMAIN);?></b></p>
        <blockquote>
            <ul><li><?php _e('Only use lower-case characters to solve this.', B7EDBP_TEXT_DOMAIN);?></li></ul>
        </blockquote>
        <?php
    }
}