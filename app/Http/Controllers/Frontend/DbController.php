<?php
namespace App\Http\Controllers\Frontend;

use App\Model\User;
use App\Model\Address;
use App\Model\Post;

class DbController extends Controller
{

    
    /**
     * Db模板测试
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function index()
    {
        view()->share('js', 'vue.js');
        return parent::index();
    }

    /**
     * @desc hasOne
     * @method get
     * @param integer $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function demo1($id)
    {
        $user=User::find($id);
        dump($user->address->toArray());
        
        $address=Address::find(1);
        dump($address->user->toArray());
        
        $address=Address::find(3);
        dump($address->user->toArray());
    }
    
    /**
     * @desc hasMany
     * @method get
     */
    
    function demo2(){
        $user=User::with('address','post')->find(1);
       // $user=User::find(1);
        $posts=$user->post;
        foreach($posts as $post){
           dump ($post->title);
        }
        
        
        
        $post= Post::find(4);
       // dump($post->user->toArray());
    }
    
    /**
     * @desc 插入
     * @method get
     */
    function demo3(){
        $user = User::find(1);
        $user->post()->save(new Post(['title'=>'blog 06']));
    }
    
    /**
     * @desc create([])方法
     * @method get
     */
    function demo4(){
        User::find(1)->post()->create(['title'=>'blog 07']);
    }
    
    /**
     * @desc createMany();
     * @method get
     */
    function demo5(){
        User::find(1)->post()->createMany([
            ['title'=>'blog 08'],
            ['title'=>'blog 09'],
            ['title'=>'blog 10'],
            ['title'=>'blog 11'],
            ['title'=>'blog 12'],
        ]);
    }
    
    /**
     * 表格
     * @method get
     * @return
     */
    function table(){
        $db1=['admin_passwords','admin_system_messages','admin_user','admin_user_session','adminnotification_inbox','amazon_customer','amazon_pending_authorization','amazon_pending_capture','amazon_pending_refund','amazon_quote','amazon_sales_order','authorization_role','authorization_rule','cache','cache_tag','captcha_log','catalog_category_entity','catalog_category_entity_datetime','catalog_category_entity_decimal','catalog_category_entity_int','catalog_category_entity_text','catalog_category_entity_varchar','catalog_category_product','catalog_category_product_index','catalog_category_product_index_replica','catalog_category_product_index_tmp','catalog_compare_item','catalog_eav_attribute','catalog_product_bundle_option','catalog_product_bundle_option_value','catalog_product_bundle_price_index','catalog_product_bundle_selection','catalog_product_bundle_selection_price','catalog_product_bundle_stock_index','catalog_product_entity','catalog_product_entity_datetime','catalog_product_entity_decimal','catalog_product_entity_gallery','catalog_product_entity_int','catalog_product_entity_media_gallery','catalog_product_entity_media_gallery_value','catalog_product_entity_media_gallery_value_to_entity','catalog_product_entity_media_gallery_value_video','catalog_product_entity_text','catalog_product_entity_tier_price','catalog_product_entity_varchar','catalog_product_frontend_action','catalog_product_index_eav','catalog_product_index_eav_decimal','catalog_product_index_eav_decimal_idx','catalog_product_index_eav_decimal_replica','catalog_product_index_eav_decimal_tmp','catalog_product_index_eav_idx','catalog_product_index_eav_replica','catalog_product_index_eav_temp','catalog_product_index_eav_tmp','catalog_product_index_price','catalog_product_index_price_bundle_idx','catalog_product_index_price_bundle_opt_idx','catalog_product_index_price_bundle_opt_temp','catalog_product_index_price_bundle_opt_tmp','catalog_product_index_price_bundle_sel_idx','catalog_product_index_price_bundle_sel_temp','catalog_product_index_price_bundle_sel_tmp','catalog_product_index_price_bundle_temp','catalog_product_index_price_bundle_tmp','catalog_product_index_price_cfg_opt_agr_idx','catalog_product_index_price_cfg_opt_agr_temp','catalog_product_index_price_cfg_opt_agr_tmp','catalog_product_index_price_cfg_opt_idx','catalog_product_index_price_cfg_opt_temp','catalog_product_index_price_cfg_opt_tmp','catalog_product_index_price_downlod_idx','catalog_product_index_price_downlod_temp','catalog_product_index_price_downlod_tmp','catalog_product_index_price_final_idx','catalog_product_index_price_final_temp','catalog_product_index_price_final_tmp','catalog_product_index_price_idx','catalog_product_index_price_opt_agr_idx','catalog_product_index_price_opt_agr_temp','catalog_product_index_price_opt_agr_tmp','catalog_product_index_price_opt_idx','catalog_product_index_price_opt_temp','catalog_product_index_price_opt_tmp','catalog_product_index_price_replica','catalog_product_index_price_tmp','catalog_product_index_tier_price','catalog_product_index_website','catalog_product_link','catalog_product_link_attribute','catalog_product_link_attribute_decimal','catalog_product_link_attribute_int','catalog_product_link_attribute_varchar','catalog_product_link_type','catalog_product_option','catalog_product_option_price','catalog_product_option_title','catalog_product_option_type_price','catalog_product_option_type_title','catalog_product_option_type_value','catalog_product_relation','catalog_product_super_attribute','catalog_product_super_attribute_label','catalog_product_super_link','catalog_product_website','catalog_url_rewrite_product_category','cataloginventory_stock','cataloginventory_stock_item','cataloginventory_stock_status','cataloginventory_stock_status_idx','cataloginventory_stock_status_replica','cataloginventory_stock_status_tmp','catalogrule','catalogrule_customer_group','catalogrule_group_website','catalogrule_group_website_replica','catalogrule_product','catalogrule_product_price','catalogrule_product_price_replica','catalogrule_product_replica','catalogrule_website','checkout_agreement','checkout_agreement_store','cms_block','cms_block_store','cms_page','cms_page_store','core_config_data','cron_schedule','customer_address_entity','customer_address_entity_datetime','customer_address_entity_decimal','customer_address_entity_int','customer_address_entity_text','customer_address_entity_varchar','customer_eav_attribute','customer_eav_attribute_website','customer_entity','customer_entity_datetime','customer_entity_decimal','customer_entity_int','customer_entity_text','customer_entity_varchar','customer_form_attribute','customer_grid_flat','customer_group','customer_log','customer_visitor','design_change','design_config_grid_flat','directory_country','directory_country_format','directory_country_region','directory_country_region_name','directory_currency_rate','downloadable_link','downloadable_link_price','downloadable_link_purchased','downloadable_link_purchased_item','downloadable_link_title','downloadable_sample','downloadable_sample_title','eav_attribute','eav_attribute_group','eav_attribute_label','eav_attribute_option','eav_attribute_option_swatch','eav_attribute_option_value','eav_attribute_set','eav_entity','eav_entity_attribute','eav_entity_datetime','eav_entity_decimal','eav_entity_int','eav_entity_store','eav_entity_text','eav_entity_type','eav_entity_varchar','eav_form_element','eav_form_fieldset','eav_form_fieldset_label','eav_form_type','eav_form_type_entity','email_abandoned_cart','email_automation','email_campaign','email_catalog','email_contact','email_importer','email_order','email_review','email_rules','email_template','email_wishlist','flag','gift_message','googleoptimizer_code','import_history','importexport_importdata','indexer_state','integration','klarna_core_order','klarna_payments_quote','layout_link','layout_update','mview_state','newsletter_problem','newsletter_queue','newsletter_queue_link','newsletter_queue_store_link','newsletter_subscriber','newsletter_template','oauth_consumer','oauth_nonce','oauth_token','oauth_token_request_log','password_reset_request_event','paypal_billing_agreement','paypal_billing_agreement_order','paypal_cert','paypal_payment_transaction','paypal_settlement_report','paypal_settlement_report_row','persistent_session','product_alert_price','product_alert_stock','quote','quote_address','quote_address_item','quote_id_mask','quote_item','quote_item_option','quote_payment','quote_shipping_rate','rating','rating_entity','rating_option','rating_option_vote','rating_option_vote_aggregated','rating_store','rating_title','release_notification_viewer_log','report_compared_product_index','report_event','report_event_types','report_viewed_product_aggregated_daily','report_viewed_product_aggregated_monthly','report_viewed_product_aggregated_yearly','report_viewed_product_index','reporting_counts','reporting_module_status','reporting_orders','reporting_system_updates','reporting_users','review','review_detail','review_entity','review_entity_summary','review_status','review_store','sales_bestsellers_aggregated_daily','sales_bestsellers_aggregated_monthly','sales_bestsellers_aggregated_yearly','sales_creditmemo','sales_creditmemo_comment','sales_creditmemo_grid','sales_creditmemo_item','sales_invoice','sales_invoice_comment','sales_invoice_grid','sales_invoice_item','sales_invoiced_aggregated','sales_invoiced_aggregated_order','sales_order','sales_order_address','sales_order_aggregated_created','sales_order_aggregated_updated','sales_order_grid','sales_order_item','sales_order_payment','sales_order_status','sales_order_status_history','sales_order_status_label','sales_order_status_state','sales_order_tax','sales_order_tax_item','sales_payment_transaction','sales_refunded_aggregated','sales_refunded_aggregated_order','sales_sequence_meta','sales_sequence_profile','sales_shipment','sales_shipment_comment','sales_shipment_grid','sales_shipment_item','sales_shipment_track','sales_shipping_aggregated','sales_shipping_aggregated_order','salesrule','salesrule_coupon','salesrule_coupon_aggregated','salesrule_coupon_aggregated_order','salesrule_coupon_aggregated_updated','salesrule_coupon_usage','salesrule_customer','salesrule_customer_group','salesrule_label','salesrule_product_attribute','salesrule_website','search_query','search_synonyms','search_tmp_5b059d7db6dab2_07458425','search_tmp_5b059d7dc843b2_83403511','search_tmp_5b059f7b3b5e67_78217979','search_tmp_5b059f7b57b925_51568295','search_tmp_5b059f81416498_49144433','search_tmp_5b059f81600f83_43583975','search_tmp_5b05a0c28dda90_79066136','search_tmp_5b05a0c2ba00d0_80285522','search_tmp_5b05a0c75eb127_86866728','search_tmp_5b05a0c77955a9_37646000','search_tmp_5b062fd5e8d1d7_20845998','search_tmp_5b062fd6318445_32066170','search_tmp_5b067c7abd8d63_61312676','search_tmp_5b067c7c716ee5_48424046','search_tmp_5b06845ea26281_70912173','search_tmp_5b06845ee7c6c5_76785383','search_tmp_5b0688a5e65b56_54967439','search_tmp_5b0688a62afdf9_45133090','search_tmp_5b068a782a6373_46408575','search_tmp_5b068a7854d1a7_65052123','search_tmp_5b068bedd10955_17431294','search_tmp_5b068bee194c70_77404348','search_tmp_5b068bf3d2e8b6_21959742','search_tmp_5b068bf42ca264_30252351','search_tmp_5b06b0b68a59d7_13745104','search_tmp_5b06b0b6a63c82_99608886','search_tmp_5b06b0b7d67f20_22919441','search_tmp_5b06b0b8641662_35604364','search_tmp_5b06b348de7a62_35515015','search_tmp_5b06b3490c7090_13751056','search_tmp_5b06b4dc4a2690_47457068','search_tmp_5b06b4dc6ada01_59436948','search_tmp_5b06b4ea9f9788_40090135','search_tmp_5b06b4eabb60d8_77294819','search_tmp_5b06b5b3e59746_44335463','search_tmp_5b06b5b40c4f11_87829624','search_tmp_5b06b5bc98b3e4_94514654','search_tmp_5b06b5bcca5085_82817711','search_tmp_5b06b5bd4fd009_57470967','search_tmp_5b06b5bd738226_38719569','search_tmp_5b06b5bdea6908_46557197','search_tmp_5b06b5be113661_35349524','search_tmp_5b06b5e4a0b0d0_53179399','search_tmp_5b06b5e4c542b5_91760235','search_tmp_5b06b5e9ce04a0_26242025','search_tmp_5b06b5ea036655_19401228','search_tmp_5b06b5ecf26cd3_41245538','search_tmp_5b06b5ed26f756_45983890','search_tmp_5b06b61fd05ba9_02043091','search_tmp_5b06b6200c50a0_60622674','search_tmp_5b06b623b35151_83798043','search_tmp_5b06b623d99d60_49335274','search_tmp_5b06b6280d5644_27015113','search_tmp_5b06b6283d8df6_13524028','search_tmp_5b06b62be797a9_95275763','search_tmp_5b06b62c164213_10216245','search_tmp_5b06b63011c9a0_80306072','search_tmp_5b06b630186748_37481095','search_tmp_5b06b634b5bf47_43032651','search_tmp_5b06b634c0a713_07527996','search_tmp_5b06b7ac4fdfc7_25884872','search_tmp_5b06b7ac569893_99800990','search_tmp_5b06b7b22eb271_92614745','search_tmp_5b06b7b2345c02_09941970','search_tmp_5b06b7b3b2d0e4_85805634','search_tmp_5b06b7b3c18da7_59359021','search_tmp_5b06b7b3f261f9_86466652','search_tmp_5b06b7b40e56b9_41696037','search_tmp_5b06b7bc2dd2f5_52594933','search_tmp_5b06b7bc478672_56055902','search_tmp_5b06b7c2830fa9_54610935','search_tmp_5b06b7c28bcf80_06106013','search_tmp_5b06b7e13f2338_26958460','search_tmp_5b06b7e14d41f8_67446839','search_tmp_5b06b872c025e1_87078851','search_tmp_5b06b872d0f306_32258322','search_tmp_5b06cd5125ce32_77211436','search_tmp_5b06cd51492628_57312958','search_tmp_5b06d878db5c74_10361465','search_tmp_5b06d878ecb282_57260919','search_tmp_5b06d88791df56_28815852','search_tmp_5b06d887aec078_79596642','search_tmp_5b06d88a521f30_33985791','search_tmp_5b06d88a6e0a49_77396552','search_tmp_5b07d60eaec350_41422552','search_tmp_5b07d60f20d950_73001805','search_tmp_5b07d6143ed285_91357575','search_tmp_5b07d6146e1ec9_42501479','search_tmp_5b07d677630138_95332054','search_tmp_5b07d6779f1e62_32266724','search_tmp_5b07d7a8bef012_83119126','search_tmp_5b07d7a8d747a6_57670178','search_tmp_5b07d7ec151e64_27135566','search_tmp_5b07d7ec386584_75537165','search_tmp_5b07d81e3e8537_67575496','search_tmp_5b07d81e4e4e57_27050027','sendfriend_log','sequence_creditmemo_0','sequence_creditmemo_1','sequence_invoice_0','sequence_invoice_1','sequence_order_0','sequence_order_1','sequence_shipment_0','sequence_shipment_1','session','setup_module','shipping_tablerate','signifyd_case','sitemap','store','store_group','store_website','tax_calculation','tax_calculation_rate','tax_calculation_rate_title','tax_calculation_rule','tax_class','tax_order_aggregated_created','tax_order_aggregated_updated','temando_checkout_address','temando_order','temando_shipment','temp_catalog_category_tree_index_061c856d','temp_catalog_category_tree_index_06f76091','temp_catalog_category_tree_index_0bc19454','temp_catalog_category_tree_index_17ca1123','temp_catalog_category_tree_index_1ac21335','temp_catalog_category_tree_index_1f4fb4ba','temp_catalog_category_tree_index_3c6d4f87','temp_catalog_category_tree_index_4bcfefad','temp_catalog_category_tree_index_4e950995','temp_catalog_category_tree_index_68a8c97b','temp_catalog_category_tree_index_703349dd','temp_catalog_category_tree_index_74292793','temp_catalog_category_tree_index_7ce2ac7e','temp_catalog_category_tree_index_7f9d7697','temp_catalog_category_tree_index_815a44f4','temp_catalog_category_tree_index_815e9666','temp_catalog_category_tree_index_831fb3f3','temp_catalog_category_tree_index_8b1dabcc','temp_catalog_category_tree_index_8deed263','temp_catalog_category_tree_index_930d97b0','temp_catalog_category_tree_index_a324d227','temp_catalog_category_tree_index_a7ced96a','temp_catalog_category_tree_index_b1ed2589','temp_catalog_category_tree_index_b3d027e9','temp_catalog_category_tree_index_b6494017','temp_catalog_category_tree_index_c92cce5c','temp_catalog_category_tree_index_d0f84d04','temp_catalog_category_tree_index_dda88ec1','temp_catalog_category_tree_index_ebffbc5b','temp_catalog_category_tree_index_ee33e62e','temp_catalog_category_tree_index_ef3c473d','temp_catalog_category_tree_index_fdc2f17c','temp_catalog_category_tree_index_ff3c2664','theme','theme_file','translation','ui_bookmark','url_rewrite','variable','variable_value','vault_payment_token','vault_payment_token_order_payment_link','vertex_customer_code','vertex_invoice_sent','vertex_taxrequest','weee_tax','widget','widget_instance','widget_instance_page','widget_instance_page_layout','wishlist','wishlist_item','wishlist_item_option'];
        $db2=['admin_passwords','admin_system_messages','admin_user','admin_user_session','adminnotification_inbox','amazon_customer','amazon_pending_authorization','amazon_pending_capture','amazon_pending_refund','amazon_quote','amazon_sales_order','authorization_role','authorization_rule','cache','cache_tag','captcha_log','catalog_category_entity','catalog_category_entity_datetime','catalog_category_entity_decimal','catalog_category_entity_int','catalog_category_entity_text','catalog_category_entity_varchar','catalog_category_product','catalog_category_product_index','catalog_category_product_index_replica','catalog_category_product_index_tmp','catalog_compare_item','catalog_eav_attribute','catalog_product_bundle_option','catalog_product_bundle_option_value','catalog_product_bundle_price_index','catalog_product_bundle_selection','catalog_product_bundle_selection_price','catalog_product_bundle_stock_index','catalog_product_entity','catalog_product_entity_datetime','catalog_product_entity_decimal','catalog_product_entity_gallery','catalog_product_entity_int','catalog_product_entity_media_gallery','catalog_product_entity_media_gallery_value','catalog_product_entity_media_gallery_value_to_entity','catalog_product_entity_media_gallery_value_video','catalog_product_entity_text','catalog_product_entity_tier_price','catalog_product_entity_varchar','catalog_product_frontend_action','catalog_product_index_eav','catalog_product_index_eav_decimal','catalog_product_index_eav_decimal_idx','catalog_product_index_eav_decimal_replica','catalog_product_index_eav_decimal_tmp','catalog_product_index_eav_idx','catalog_product_index_eav_replica','catalog_product_index_eav_temp','catalog_product_index_eav_tmp','catalog_product_index_price','catalog_product_index_price_bundle_idx','catalog_product_index_price_bundle_opt_idx','catalog_product_index_price_bundle_opt_temp','catalog_product_index_price_bundle_opt_tmp','catalog_product_index_price_bundle_sel_idx','catalog_product_index_price_bundle_sel_temp','catalog_product_index_price_bundle_sel_tmp','catalog_product_index_price_bundle_temp','catalog_product_index_price_bundle_tmp','catalog_product_index_price_cfg_opt_agr_idx','catalog_product_index_price_cfg_opt_agr_temp','catalog_product_index_price_cfg_opt_agr_tmp','catalog_product_index_price_cfg_opt_idx','catalog_product_index_price_cfg_opt_temp','catalog_product_index_price_cfg_opt_tmp','catalog_product_index_price_downlod_idx','catalog_product_index_price_downlod_temp','catalog_product_index_price_downlod_tmp','catalog_product_index_price_final_idx','catalog_product_index_price_final_temp','catalog_product_index_price_final_tmp','catalog_product_index_price_idx','catalog_product_index_price_opt_agr_idx','catalog_product_index_price_opt_agr_temp','catalog_product_index_price_opt_agr_tmp','catalog_product_index_price_opt_idx','catalog_product_index_price_opt_temp','catalog_product_index_price_opt_tmp','catalog_product_index_price_replica','catalog_product_index_price_tmp','catalog_product_index_tier_price','catalog_product_index_website','catalog_product_link','catalog_product_link_attribute','catalog_product_link_attribute_decimal','catalog_product_link_attribute_int','catalog_product_link_attribute_varchar','catalog_product_link_type','catalog_product_option','catalog_product_option_price','catalog_product_option_title','catalog_product_option_type_price','catalog_product_option_type_title','catalog_product_option_type_value','catalog_product_relation','catalog_product_super_attribute','catalog_product_super_attribute_label','catalog_product_super_link','catalog_product_website','catalog_url_rewrite_product_category','cataloginventory_stock','cataloginventory_stock_item','cataloginventory_stock_status','cataloginventory_stock_status_idx','cataloginventory_stock_status_replica','cataloginventory_stock_status_tmp','catalogrule','catalogrule_customer_group','catalogrule_group_website','catalogrule_group_website_replica','catalogrule_product','catalogrule_product_price','catalogrule_product_price_replica','catalogrule_product_replica','catalogrule_website','catalogsearch_fulltext_scope1','checkout_agreement','checkout_agreement_store','cms_block','cms_block_store','cms_page','cms_page_store','core_config_data','cron_schedule','customer_address_entity','customer_address_entity_datetime','customer_address_entity_decimal','customer_address_entity_int','customer_address_entity_text','customer_address_entity_varchar','customer_eav_attribute','customer_eav_attribute_website','customer_entity','customer_entity_datetime','customer_entity_decimal','customer_entity_int','customer_entity_text','customer_entity_varchar','customer_form_attribute','customer_grid_flat','customer_group','customer_log','customer_visitor','design_change','design_config_grid_flat','directory_country','directory_country_format','directory_country_region','directory_country_region_name','directory_currency_rate','downloadable_link','downloadable_link_price','downloadable_link_purchased','downloadable_link_purchased_item','downloadable_link_title','downloadable_sample','downloadable_sample_title','eav_attribute','eav_attribute_group','eav_attribute_label','eav_attribute_option','eav_attribute_option_swatch','eav_attribute_option_value','eav_attribute_set','eav_entity','eav_entity_attribute','eav_entity_datetime','eav_entity_decimal','eav_entity_int','eav_entity_store','eav_entity_text','eav_entity_type','eav_entity_varchar','eav_form_element','eav_form_fieldset','eav_form_fieldset_label','eav_form_type','eav_form_type_entity','email_abandoned_cart','email_automation','email_campaign','email_catalog','email_contact','email_importer','email_order','email_review','email_rules','email_template','email_wishlist','flag','gift_message','googleoptimizer_code','import_history','importexport_importdata','indexer_state','integration','klarna_core_order','klarna_payments_quote','layout_link','layout_update','mview_state','newsletter_problem','newsletter_queue','newsletter_queue_link','newsletter_queue_store_link','newsletter_subscriber','newsletter_template','oauth_consumer','oauth_nonce','oauth_token','oauth_token_request_log','password_reset_request_event','paypal_billing_agreement','paypal_billing_agreement_order','paypal_cert','paypal_payment_transaction','paypal_settlement_report','paypal_settlement_report_row','persistent_session','product_alert_price','product_alert_stock','quote','quote_address','quote_address_item','quote_id_mask','quote_item','quote_item_option','quote_payment','quote_shipping_rate','rating','rating_entity','rating_option','rating_option_vote','rating_option_vote_aggregated','rating_store','rating_title','release_notification_viewer_log','report_compared_product_index','report_event','report_event_types','report_viewed_product_aggregated_daily','report_viewed_product_aggregated_monthly','report_viewed_product_aggregated_yearly','report_viewed_product_index','reporting_counts','reporting_module_status','reporting_orders','reporting_system_updates','reporting_users','review','review_detail','review_entity','review_entity_summary','review_status','review_store','sales_bestsellers_aggregated_daily','sales_bestsellers_aggregated_monthly','sales_bestsellers_aggregated_yearly','sales_creditmemo','sales_creditmemo_comment','sales_creditmemo_grid','sales_creditmemo_item','sales_invoice','sales_invoice_comment','sales_invoice_grid','sales_invoice_item','sales_invoiced_aggregated','sales_invoiced_aggregated_order','sales_order','sales_order_address','sales_order_aggregated_created','sales_order_aggregated_updated','sales_order_grid','sales_order_item','sales_order_payment','sales_order_status','sales_order_status_history','sales_order_status_label','sales_order_status_state','sales_order_tax','sales_order_tax_item','sales_payment_transaction','sales_refunded_aggregated','sales_refunded_aggregated_order','sales_sequence_meta','sales_sequence_profile','sales_shipment','sales_shipment_comment','sales_shipment_grid','sales_shipment_item','sales_shipment_track','sales_shipping_aggregated','sales_shipping_aggregated_order','salesrule','salesrule_coupon','salesrule_coupon_aggregated','salesrule_coupon_aggregated_order','salesrule_coupon_aggregated_updated','salesrule_coupon_usage','salesrule_customer','salesrule_customer_group','salesrule_label','salesrule_product_attribute','salesrule_website','search_query','search_synonyms','search_tmp_5b059d7db6dab2_07458425','search_tmp_5b059d7dc843b2_83403511','search_tmp_5b059f7b3b5e67_78217979','search_tmp_5b059f7b57b925_51568295','search_tmp_5b059f81416498_49144433','search_tmp_5b059f81600f83_43583975','search_tmp_5b05a0c28dda90_79066136','search_tmp_5b05a0c2ba00d0_80285522','search_tmp_5b05a0c75eb127_86866728','search_tmp_5b05a0c77955a9_37646000','search_tmp_5b062fd5e8d1d7_20845998','search_tmp_5b062fd6318445_32066170','search_tmp_5b067c7abd8d63_61312676','search_tmp_5b067c7c716ee5_48424046','search_tmp_5b06845ea26281_70912173','search_tmp_5b06845ee7c6c5_76785383','search_tmp_5b0688a5e65b56_54967439','search_tmp_5b0688a62afdf9_45133090','search_tmp_5b068a782a6373_46408575','search_tmp_5b068a7854d1a7_65052123','search_tmp_5b068bedd10955_17431294','search_tmp_5b068bee194c70_77404348','search_tmp_5b068bf3d2e8b6_21959742','search_tmp_5b068bf42ca264_30252351','search_tmp_5b06b0b68a59d7_13745104','search_tmp_5b06b0b6a63c82_99608886','search_tmp_5b06b0b7d67f20_22919441','search_tmp_5b06b0b8641662_35604364','search_tmp_5b06b348de7a62_35515015','search_tmp_5b06b3490c7090_13751056','search_tmp_5b06b4dc4a2690_47457068','search_tmp_5b06b4dc6ada01_59436948','search_tmp_5b06b4ea9f9788_40090135','search_tmp_5b06b4eabb60d8_77294819','search_tmp_5b06b5b3e59746_44335463','search_tmp_5b06b5b40c4f11_87829624','search_tmp_5b06b5bc98b3e4_94514654','search_tmp_5b06b5bcca5085_82817711','search_tmp_5b06b5bd4fd009_57470967','search_tmp_5b06b5bd738226_38719569','search_tmp_5b06b5bdea6908_46557197','search_tmp_5b06b5be113661_35349524','search_tmp_5b06b5e4a0b0d0_53179399','search_tmp_5b06b5e4c542b5_91760235','search_tmp_5b06b5e9ce04a0_26242025','search_tmp_5b06b5ea036655_19401228','search_tmp_5b06b5ecf26cd3_41245538','search_tmp_5b06b5ed26f756_45983890','search_tmp_5b06b61fd05ba9_02043091','search_tmp_5b06b6200c50a0_60622674','search_tmp_5b06b623b35151_83798043','search_tmp_5b06b623d99d60_49335274','search_tmp_5b06b6280d5644_27015113','search_tmp_5b06b6283d8df6_13524028','search_tmp_5b06b62be797a9_95275763','search_tmp_5b06b62c164213_10216245','search_tmp_5b06b63011c9a0_80306072','search_tmp_5b06b630186748_37481095','search_tmp_5b06b634b5bf47_43032651','search_tmp_5b06b634c0a713_07527996','search_tmp_5b06b7ac4fdfc7_25884872','search_tmp_5b06b7ac569893_99800990','search_tmp_5b06b7b22eb271_92614745','search_tmp_5b06b7b2345c02_09941970','search_tmp_5b06b7b3b2d0e4_85805634','search_tmp_5b06b7b3c18da7_59359021','search_tmp_5b06b7b3f261f9_86466652','search_tmp_5b06b7b40e56b9_41696037','search_tmp_5b06b7bc2dd2f5_52594933','search_tmp_5b06b7bc478672_56055902','search_tmp_5b06b7c2830fa9_54610935','search_tmp_5b06b7c28bcf80_06106013','search_tmp_5b06b7e13f2338_26958460','search_tmp_5b06b7e14d41f8_67446839','search_tmp_5b06b872c025e1_87078851','search_tmp_5b06b872d0f306_32258322','search_tmp_5b06cd5125ce32_77211436','search_tmp_5b06cd51492628_57312958','search_tmp_5b06d878db5c74_10361465','search_tmp_5b06d878ecb282_57260919','search_tmp_5b06d88791df56_28815852','search_tmp_5b06d887aec078_79596642','search_tmp_5b06d88a521f30_33985791','search_tmp_5b06d88a6e0a49_77396552','search_tmp_5b07d60eaec350_41422552','search_tmp_5b07d60f20d950_73001805','search_tmp_5b07d6143ed285_91357575','search_tmp_5b07d6146e1ec9_42501479','search_tmp_5b07d677630138_95332054','search_tmp_5b07d6779f1e62_32266724','search_tmp_5b07d7a8bef012_83119126','search_tmp_5b07d7a8d747a6_57670178','search_tmp_5b07d7ec151e64_27135566','search_tmp_5b07d7ec386584_75537165','search_tmp_5b07d81e3e8537_67575496','search_tmp_5b07d81e4e4e57_27050027','search_tmp_5b07d87babd7c3_23816075','search_tmp_5b07d87bd71030_25370050','search_tmp_5b07d87ee58a48_49601158','search_tmp_5b07d87f0a24c4_26579466','sendfriend_log','sequence_creditmemo_0','sequence_creditmemo_1','sequence_invoice_0','sequence_invoice_1','sequence_order_0','sequence_order_1','sequence_shipment_0','sequence_shipment_1','session','setup_module','shipping_tablerate','signifyd_case','sitemap','store','store_group','store_website','tax_calculation','tax_calculation_rate','tax_calculation_rate_title','tax_calculation_rule','tax_class','tax_order_aggregated_created','tax_order_aggregated_updated','temando_checkout_address','temando_order','temando_shipment','temp_catalog_category_tree_index_061c856d','temp_catalog_category_tree_index_06f76091','temp_catalog_category_tree_index_0bc19454','temp_catalog_category_tree_index_12dd6ccb','temp_catalog_category_tree_index_17ca1123','temp_catalog_category_tree_index_1ac21335','temp_catalog_category_tree_index_1f4fb4ba','temp_catalog_category_tree_index_3c6d4f87','temp_catalog_category_tree_index_4bcfefad','temp_catalog_category_tree_index_4e950995','temp_catalog_category_tree_index_68a8c97b','temp_catalog_category_tree_index_703349dd','temp_catalog_category_tree_index_74292793','temp_catalog_category_tree_index_7ce2ac7e','temp_catalog_category_tree_index_7f9d7697','temp_catalog_category_tree_index_815a44f4','temp_catalog_category_tree_index_815e9666','temp_catalog_category_tree_index_831fb3f3','temp_catalog_category_tree_index_8b1dabcc','temp_catalog_category_tree_index_8deed263','temp_catalog_category_tree_index_930d97b0','temp_catalog_category_tree_index_a324d227','temp_catalog_category_tree_index_a47dcb89','temp_catalog_category_tree_index_a7ced96a','temp_catalog_category_tree_index_b1ed2589','temp_catalog_category_tree_index_b3d027e9','temp_catalog_category_tree_index_b6494017','temp_catalog_category_tree_index_c92cce5c','temp_catalog_category_tree_index_d0f84d04','temp_catalog_category_tree_index_d5cc97b6','temp_catalog_category_tree_index_dda88ec1','temp_catalog_category_tree_index_ebffbc5b','temp_catalog_category_tree_index_ee33e62e','temp_catalog_category_tree_index_ef3c473d','temp_catalog_category_tree_index_f9a87c8b','temp_catalog_category_tree_index_fdc2f17c','temp_catalog_category_tree_index_ff3c2664','theme','theme_file','translation','ui_bookmark','url_rewrite','variable','variable_value','vault_payment_token','vault_payment_token_order_payment_link','vertex_customer_code','vertex_invoice_sent','vertex_taxrequest','weee_tax','widget','widget_instance','widget_instance_page','widget_instance_page_layout','wishlist','wishlist_item','wishlist_item_option'];
        dump(array_diff($db2, $db1));
    }
    
    /**
     * join
     * @method get
     */
    function join(){
       $user=\DB::table('users')->select()->get();
       $user=\DB::table('users')->first();
       $user=\DB::table('users')->value('id');
       $user=\DB::table('users')->pluck('name','id')->toArray();
       $user=\DB::table('users')->selectRaw('count(name) as count')->get();
       $user=\DB::table('users as m')->join('addresses as s','m.id','=','s.user_id')->selectRaw('m.*,s.city')->get();
       $user=\DB::table('users')->find(2);
       dump($user);
    }
    
   
}

