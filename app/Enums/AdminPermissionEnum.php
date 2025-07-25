<?php
namespace App\Enums;

enum AdminPermissionEnum: string
{
    // صلاحيات عامة
    case LOGIN = 'login';
    case VIEW_DASHBOARD = 'view_dashboard';
    case LOGOUT = 'logout';

    // إدارة الأدوار والصلاحيات
    case VIEW_ROLES = 'view_roles';
    case VIEW_ROLE_DETAILS = 'view_role_details';
    case ADD_ROLE = 'add_role';
    case EDIT_ROLE = 'edit_role';
    case SAVE_ROLE = 'save_role';

    // إدارة الولايات والمدن
    case VIEW_STATES = 'view_states';
    case ADD_STATE = 'add_state';
    case EDIT_STATE = 'edit_state';
    case SAVE_STATE = 'save_state';

    case VIEW_CITIES = 'view_cities';
    case ADD_CITY = 'add_city';
    case EDIT_CITY = 'edit_city';
    case SAVE_CITY = 'save_city';

    // إدارة الأقسام والفئات
    case VIEW_CATEGORIES = 'view_categories';
    case VIEW_CATEGORY_DETAILS = 'view_category_details';
    case ADD_CATEGORY = 'add_category';
    case EDIT_CATEGORY = 'edit_category';
    case SAVE_CATEGORY = 'save_category';

    case VIEW_SUBCATEGORIES = 'view_subcategories';
    case VIEW_SUBCATEGORY_DETAILS = 'view_subcategory_details';
    case ADD_SUBCATEGORY = 'add_subcategory';
    case EDIT_SUBCATEGORY = 'edit_subcategory';
    case SAVE_SUBCATEGORY = 'save_subcategory';

    // إدارة الوسوم
    case VIEW_TAGS = 'view_tags';
    case VIEW_TAG_DETAILS = 'view_tag_details';
    case ADD_TAG = 'add_tag';
    case EDIT_TAG = 'edit_tag';
    case SAVE_TAG = 'save_tag';

    // إدارة مزودي الخدمة
    case VIEW_SERVICE_PROVIDERS = 'view_service_providers';
    case VIEW_SERVICE_PROVIDER_DETAILS = 'view_service_provider_details';
    case ADD_SERVICE_PROVIDER = 'add_service_provider';
    case EDIT_SERVICE_PROVIDER = 'edit_service_provider';
    case SAVE_SERVICE_PROVIDER = 'save_service_provider';

    // طلبات "كن مزود خدمة"
    case VIEW_BECOME_PROVIDER_REQUESTS = 'view_become_provider_requests';
    case CHANGE_REQUEST_STATUS = 'change_request_status';
    case SEARCH_REQUESTS = 'search_requests';
    case FILTER_REQUESTS = 'filter_requests';

    // إدارة السلايدر
    case VIEW_SLIDERS = 'view_sliders';
    case VIEW_SLIDER_DETAILS = 'view_slider_details';
    case ADD_SLIDER = 'add_slider';
    case EDIT_SLIDER = 'edit_slider';
    case SAVE_SLIDER = 'save_slider';
    case CHANGE_SLIDER_STATUS = 'change_slider_status';

    // إدارة العروض
    case VIEW_OFFERS = 'view_offers';
    case VIEW_OFFER_DETAILS = 'view_offer_details';
    case ADD_OFFER = 'add_offer';
    case EDIT_OFFER = 'edit_offer';
    case SAVE_OFFER = 'save_offer';

    // إدارة الكيانات الحكومية
    case VIEW_GOV_ENTITIES = 'view_gov_entities';
    case VIEW_GOV_ENTITY_DETAILS = 'view_gov_entity_details';
    case ADD_GOV_ENTITY = 'add_gov_entity';
    case EDIT_GOV_ENTITY = 'edit_gov_entity';
    case SAVE_GOV_ENTITY = 'save_gov_entity';

    // إدارة العملاء
    case VIEW_CUSTOMERS = 'view_customers';
    case VIEW_CUSTOMER_DETAILS = 'view_customer_details';
    case ADD_CUSTOMER = 'add_customer';
    case EDIT_CUSTOMER = 'edit_customer';
    case SAVE_CUSTOMER = 'save_customer';
    case SUSPEND_CUSTOMER = 'suspend_customer';
    case RESTORE_CUSTOMER = 'restore_customer';
    case CHANGE_CUSTOMER_STATUS = 'change_customer_status';
    case SEARCH_CUSTOMERS = 'search_customers';
    case FILTER_CUSTOMERS = 'filter_customers';

    // إدارة الإشعارات
    case VIEW_NOTIFICATIONS = 'view_notifications';
    case VIEW_NOTIFICATION_DETAILS = 'view_notification_details';
    case ADD_NOTIFICATION = 'add_notification';
    case SEND_NOTIFICATION = 'send_notification';
    case SEARCH_NOTIFICATIONS = 'search_notifications';
    case FILTER_NOTIFICATIONS = 'filter_notifications';

    // إدارة الإعدادات الشخصية (الملف الشخصي، كلمة المرور، سياسة الخصوصية، من نحن)
    case VIEW_PROFILE = 'view_profile';
    case EDIT_PROFILE = 'edit_profile';
    case SAVE_PROFILE = 'save_profile';

    case CHANGE_PASSWORD = 'change_password';

    case VIEW_PRIVACY_POLICY = 'view_privacy_policy';
    case EDIT_PRIVACY_POLICY = 'edit_privacy_policy';
    case SAVE_PRIVACY_POLICY = 'save_privacy_policy';

    case VIEW_ABOUT_US = 'view_about_us';
    case EDIT_ABOUT_US = 'edit_about_us';
    case SAVE_ABOUT_US = 'save_about_us';

    // إدارة طلبات التواصل
    case VIEW_CONTACT_US_REQUESTS = 'view_contact_us_requests';
    case CHANGE_CONTACT_REQUEST_STATUS = 'change_contact_request_status';
    case SEARCH_CONTACT_REQUESTS = 'search_contact_requests';
    case FILTER_CONTACT_REQUESTS = 'filter_contact_requests';

    // إدارة اللغة
    case VIEW_LANGUAGES = 'view_languages';
    case CHANGE_LANGUAGE = 'change_language';

    public function role()
    {
        return 'admin';
    }
}
