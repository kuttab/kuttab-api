// USA
export const locale = {
    TRANSLATOR: {
        SELECT: "اختر اللغة"
    },
    BUTTONS:{
        EDIT:'تعديل',
        SHOW:'عرض',
        DELETE:'حذف',
        CANCEL: 'الغاء',
    },
    MENU: {
        NEW: "جديد",
        ACTIONS: "Actions",
        CREATE_POST: "Create New Post",
        PAGES: "الصفحات",
        FEATURES: "Features",
        APPS: "Apps",
        DASHBOARD: "Dashboard",
        NEXT:'التالي',
        PREVIOUS:'السابق',
        SUBMIT: "ارسال",
        ERROR: "خطأ!",
    },
    AUTH: {
        GENERAL: {
            OR: "Or",
            SUBMIT_BUTTON: "ارسال",
            NO_ACCOUNT: "Don't have an account?",
            SIGNUP_BUTTON: "Sign Up",
            FORGOT_BUTTON: "نسيت كلمة السر",
            BACK_BUTTON: "Back",
            PRIVACY: "Privacy",
            LEGAL: "Legal",
            CONTACT: "Contact",
            CANCEL: 'الغاء'
        },
        LOGIN: {
            TITLE: "مرحبا بك في كُتّاب",
            SUB_TITLE: "جديد هنا؟",
            CREATE_SCHOOL: "انشاء مركز تحفيظ جديد",
            BUTTON: "تسجيل الدخول"
        },
        LOGOUT: {
            BUTTON: 'تسجيل الخروج'
        },
        FORGOT: {
            TITLE: "نسيت كلمة السر؟",
            DESC: "ادخل اسم المستخدم لأعادة تعيين كلمة السر",
            SUCCESS: "تم اعادة تعيين كلمة السر بنجاح."
        },
        REGISTER: {
            TITLE: "مدرسة جديدة",
            DESC: "ادخل تفاصيل المدرسة",
            SUCCESS: "تم اعداد لوحة التحكم الخاصة بالمدرسة"
        },
        INPUT: {
            EMAIL: "الايميل",
            FULLNAME: "الاسم الكامل",
            PASSWORD: "كلمة السر",
            CONFIRM_PASSWORD: "تأكيد كلمة السر",
            USERNAME: "اسم المستخدم"
        },
        VALIDATION: {
            FORM_VALIDATION : 'بعض المدخلات مطلوبة , قم بمراجعة البيانات',
            INVALID: "{name} قيمة خاطئة للمدخل",
            REQUIRED: "{name} مطلوب",
            MIN_LENGTH: "{{name}} minimum length is {{min}}",
            AGREEMENT_REQUIRED: "قبول الشروط مطلوب",
            NOT_FOUND: "The requested {{name}} is not found",
            INVALID_LOGIN: "The login detail is incorrect",
            REQUIRED_FIELD: "Required field",
            MIN_LENGTH_FIELD: "Minimum field length:",
            MAX_LENGTH_FIELD: "Maximum field length:",
            INVALID_FIELD: "Field is not valid"
        },
        DETAILS: {
            TITLE: 'ادارة و متابعة مراكز التحفيظ'
        }
    },
    SCHOOL: {
        CREATE: {
            TITLE: 'انشاء مدرسة جديدة',
            SUB_TITLE: 'ادخل تفاصيل المدرسة'
        },
        INPUT: {
            NAME: 'اسم المدرسة',
            DESCRIPTION: 'نظرة عامة',
            COUNTRY: 'الدولة',
            CITY: 'المدينة',
            ADDRESS: 'العنوان',
            LOGO: 'الشعار',
            LANG: 'اللغة',
            AGREE: 'أوافق على',
            CONDITIONS: 'الشروط'
        }
    },
    ECOMMERCE: {
        COMMON: {
            SELECTED_RECORDS_COUNT: "Selected records count: ",
            ALL: "All",
            SUSPENDED: "Suspended",
            ACTIVE: "Active",
            FILTER: "Filter",
            BY_STATUS: "by Status",
            BY_TYPE: "by Type",
            BUSINESS: "Business",
            INDIVIDUAL: "Individual",
            SEARCH: "Search",
            IN_ALL_FIELDS: "in all fields"
        },
        ECOMMERCE: "eCommerce",
        CUSTOMERS: {
            CUSTOMERS: "Customers",
            CUSTOMERS_LIST: "Customers list",
            NEW_CUSTOMER: "New Customer",
            DELETE_CUSTOMER_SIMPLE: {
                TITLE: "Customer Delete",
                DESCRIPTION: "Are you sure to permanently delete this customer?",
                WAIT_DESCRIPTION: "Customer is deleting...",
                MESSAGE: "Customer has been deleted"
            },
            DELETE_CUSTOMER_MULTY: {
                TITLE: "Customers Delete",
                DESCRIPTION: "Are you sure to permanently delete selected customers?",
                WAIT_DESCRIPTION: "Customers are deleting...",
                MESSAGE: "Selected customers have been deleted"
            },
            UPDATE_STATUS: {
                TITLE: "Status has been updated for selected customers",
                MESSAGE: "Selected customers status have successfully been updated"
            },
            EDIT: {
                UPDATE_MESSAGE: "Customer has been updated",
                ADD_MESSAGE: "Customer has been created"
            }
        }
    },
    QUICK_USER: {
        NAV: {
            NEW_PASSWORD_TITLE: 'كلمة سر جديد',
            NEW_PASSWORD_SUB_TITLE: 'تعيين كلمة سر جديدة بشكل عشوائي',
            DB_BACKUP_TITLE: 'نسخة احتياطية',
            DB_BACKUP_SUB_TITLE: 'تصدير واستيراد قواعد البيانات',
        }
    },
    KT_MENU: {
        DASHBOARD: 'الرئيسية',
        SCHOOLS: 'مراكز التحفيظ',
        USERS_MANAGEMENT: 'إدارة المستخدمين',
        SCHOOL_INFO: 'معلومات المركز',
        CLASSES_MANAGEMENT: 'إدارة الحلقات',
        PARENT_CHILDREN: 'تنسيب الطلاب للأباء',
    },
    USERS: {
        TITLE: 'المستخدمين',
        TYPES:{
          TEACHER:'محفظ',
          STUDENT:'طالب',
          ADMIN:'مسؤول',
          PARENT:'ولي امر',
          ASSISTANT:'مساعد محفظ'
        },
        ADD: {
            TITLE: 'اضافة مستخدم',
            NAV: {
                PERSONAL_INFO: {
                    TITLE: 'المعلومات الشخصية',
                    SUB_TITLE: 'الاسم الكامل, تاريخ الميلاد, صورة',
                    FROM:{
                        IMAGE:'الصورة الشخصية',
                        FIRST_NAME:'الاسم',
                        MIDDLE_NAME:'الأب',
                        LAST_NAME:'العائلة',
                        BIRTH_DATE:'تاريخ المبلاد',
                        ACADEMIC:'المؤهل العلمي',
                    }
                },
                ADDRESS_INFO:{
                    TITLE: 'بيانات السكن',
                    SUB_TITLE: 'الجنسية, الدولة, المدينة',
                    FROM:{
                        NATIONALITY:'الجنسية',
                        COUNTRY:'الدولة',
                        CITY:'المدينة',
                        ADDRESS:'العنوان',
                    }
                },
                CONTACT_INFO:{
                    TITLE: 'بيانات الاتصال',
                    SUB_TITLE: 'الايميل, الجوال, الهاتف',
                    FROM:{
                        EMAIL:'الايميل',
                        MOBILE:'الجوال',
                        TELEPHONE:'الهاتف',
                    }
                },
                ACCOUNT_INFO: {
                    TITLE: 'معلومات الحساب',
                    SUB_TITLE: 'نوع المستخدم, كلمة السر',
                    FROM:{
                        PASSWORD:'كلمة السر',
                        TYPE:'نوع المستخدم',
                        GENERATE:'انشاء كلمة سر عشوائية',
                    }
                },
                COMPLETED: {
                    TITLE: 'تأكيد',
                    SUB_TITLE: 'مراجعة و ارسال',
                },
            }
        },
        EDIT: {
            TITLE: 'تعديل مستخدم',
            NAV: {
                PERSONAL_INFO: {
                    TITLE: 'المعلومات الشخصية',
                    SUB_TITLE: 'الاسم الكامل, تاريخ الميلاد, صورة',
                    FROM:{
                        IMAGE:'الصورة الشخصية',
                        FIRST_NAME:'الاسم',
                        MIDDLE_NAME:'الأب',
                        LAST_NAME:'العائلة',
                        BIRTH_DATE:'تاريخ المبلاد',
                        ACADEMIC:'المؤهل العلمي',
                    }
                },
                ADDRESS_INFO:{
                    TITLE: 'بيانات السكن',
                    SUB_TITLE: 'الجنسية, الدولة, المدينة',
                    FROM:{
                        NATIONALITY:'الجنسية',
                        COUNTRY:'الدولة',
                        CITY:'المدينة',
                        ADDRESS:'العنوان',
                    }
                },
                CONTACT_INFO:{
                    TITLE: 'بيانات الاتصال',
                    SUB_TITLE: 'الايميل, الجوال, الهاتف',
                    FROM:{
                        EMAIL:'الايميل',
                        MOBILE:'الجوال',
                        TELEPHONE:'الهاتف',
                    }
                },
                ACCOUNT_INFO: {
                    TITLE: 'معلومات الحساب',
                    SUB_TITLE: 'نوع المستخدم, كلمة السر',
                    FROM:{
                        PASSWORD:'كلمة السر',
                        TYPE:'نوع المستخدم',
                        GENERATE:'انشاء كلمة سر عشوائية',
                    }
                },
                COMPLETED: {
                    TITLE: 'تأكيد',
                    SUB_TITLE: 'مراجعة و ارسال',
                },
            }
        },
        SHOW: {
            TITLE: 'تفاصيل مستخدم',
            NAV: {
                PERSONAL_INFO: {
                    TITLE: 'المعلومات الشخصية',
                    SUB_TITLE: 'الاسم الكامل, تاريخ الميلاد, صورة',
                    FROM:{
                        IMAGE:'الصورة الشخصية',
                        FIRST_NAME:'الاسم',
                        MIDDLE_NAME:'الأب',
                        LAST_NAME:'العائلة',
                        BIRTH_DATE:'تاريخ المبلاد',
                        ACADEMIC:'المؤهل العلمي',
                    }
                },
                ADDRESS_INFO:{
                    TITLE: 'بيانات السكن',
                    SUB_TITLE: 'الجنسية, الدولة, المدينة',
                    FROM:{
                        NATIONALITY:'الجنسية',
                        COUNTRY:'الدولة',
                        CITY:'المدينة',
                        ADDRESS:'العنوان',
                    }
                },
                CONTACT_INFO:{
                    TITLE: 'بيانات الاتصال',
                    SUB_TITLE: 'الايميل, الجوال, الهاتف',
                    FROM:{
                        EMAIL:'الايميل',
                        MOBILE:'الجوال',
                        TELEPHONE:'الهاتف',
                    }
                },
                ACCOUNT_INFO: {
                    TITLE: 'معلومات الحساب',
                    SUB_TITLE: 'نوع المستخدم, كلمة السر',
                    FROM:{
                        PASSWORD:'كلمة السر',
                        TYPE:'نوع المستخدم',
                        GENERATE:'انشاء كلمة سر عشوائية',
                    }
                },
                COMPLETED: {
                    TITLE: 'تأكيد',
                    SUB_TITLE: 'مراجعة و ارسال',
                },
            }
        },
        API:{
            RESPONSE:{
                MESSAGE:{
                    DELETE:'تم حذف المستخدم'
                }
            }
        }
    },
    CLASSES: {
        TITLE: 'الحلقات',
        TYPES:{
            TEACHER:'محفظ',
            STUDENT:'طالب',
            ADMIN:'مسؤول',
            PARENT:'ولي امر',
            ASSISTANT:'مساعد محفظ'
        },
        ADD: {
            TITLE: 'اضافة حلقة',
            NAV: {
                GENERAL_INFO: {
                    TITLE: 'البيانات الأساسية',
                    SUB_TITLE: 'العنوان, المحفظ, المساعد, الفئة',
                    FROM:{
                        NAME:'اسم الحلقة',
                        TEACHER:'المحفظ',
                        ASSISTANT:'مساعد المحفظ',
                        CATEGORY:'الفئة',
                    }
                },
                ADD_STUDENT: {
                    TITLE: 'اضافة طلاب',
                    SUB_TITLE: 'اضافة الطلاب الغير مدرجين في حلقة اخرى',
                    FROM:{
                        STUDENTS:'الطلاب',
                    }
                },
                COMPLETED: {
                    TITLE: 'تأكيد',
                    SUB_TITLE: 'مراجعة و ارسال',
                },
            }
        },
        EDIT: {
            TITLE: 'تعديل مستخدم',
            NAV: {
                PERSONAL_INFO: {
                    TITLE: 'المعلومات الشخصية',
                    SUB_TITLE: 'الاسم الكامل, تاريخ الميلاد, صورة',
                    FROM:{
                        IMAGE:'الصورة الشخصية',
                        FIRST_NAME:'الاسم',
                        MIDDLE_NAME:'الأب',
                        LAST_NAME:'العائلة',
                        BIRTH_DATE:'تاريخ المبلاد',
                        ACADEMIC:'المؤهل العلمي',
                    }
                },
                ADDRESS_INFO:{
                    TITLE: 'بيانات السكن',
                    SUB_TITLE: 'الجنسية, الدولة, المدينة',
                    FROM:{
                        NATIONALITY:'الجنسية',
                        COUNTRY:'الدولة',
                        CITY:'المدينة',
                        ADDRESS:'العنوان',
                    }
                },
                CONTACT_INFO:{
                    TITLE: 'بيانات الاتصال',
                    SUB_TITLE: 'الايميل, الجوال, الهاتف',
                    FROM:{
                        EMAIL:'الايميل',
                        MOBILE:'الجوال',
                        TELEPHONE:'الهاتف',
                    }
                },
                ACCOUNT_INFO: {
                    TITLE: 'معلومات الحساب',
                    SUB_TITLE: 'نوع المستخدم, كلمة السر',
                    FROM:{
                        PASSWORD:'كلمة السر',
                        TYPE:'نوع المستخدم',
                        GENERATE:'انشاء كلمة سر عشوائية',
                    }
                },
                COMPLETED: {
                    TITLE: 'تأكيد',
                    SUB_TITLE: 'مراجعة و ارسال',
                },
            }
        },
        SHOW: {
            TITLE: 'تفاصيل مستخدم',
            NAV: {
                PERSONAL_INFO: {
                    TITLE: 'المعلومات الشخصية',
                    SUB_TITLE: 'الاسم الكامل, تاريخ الميلاد, صورة',
                    FROM:{
                        IMAGE:'الصورة الشخصية',
                        FIRST_NAME:'الاسم',
                        MIDDLE_NAME:'الأب',
                        LAST_NAME:'العائلة',
                        BIRTH_DATE:'تاريخ المبلاد',
                        ACADEMIC:'المؤهل العلمي',
                    }
                },
                ADDRESS_INFO:{
                    TITLE: 'بيانات السكن',
                    SUB_TITLE: 'الجنسية, الدولة, المدينة',
                    FROM:{
                        NATIONALITY:'الجنسية',
                        COUNTRY:'الدولة',
                        CITY:'المدينة',
                        ADDRESS:'العنوان',
                    }
                },
                CONTACT_INFO:{
                    TITLE: 'بيانات الاتصال',
                    SUB_TITLE: 'الايميل, الجوال, الهاتف',
                    FROM:{
                        EMAIL:'الايميل',
                        MOBILE:'الجوال',
                        TELEPHONE:'الهاتف',
                    }
                },
                ACCOUNT_INFO: {
                    TITLE: 'معلومات الحساب',
                    SUB_TITLE: 'نوع المستخدم, كلمة السر',
                    FROM:{
                        PASSWORD:'كلمة السر',
                        TYPE:'نوع المستخدم',
                        GENERATE:'انشاء كلمة سر عشوائية',
                    }
                },
                COMPLETED: {
                    TITLE: 'تأكيد',
                    SUB_TITLE: 'مراجعة و ارسال',
                },
            }
        },
        API:{
            RESPONSE:{
                MESSAGE:{
                    DELETE:'تم حذف المستخدم'
                }
            }
        }
    },
    CATEGORY:{
        MODAL_TITLE:'اضافة فئة جديدة',
        FORM:{
            NAME:'اسم الفئة',
        },
        API:{
            STORE:{
                RESPONSE:{
                    SUCCESS:'تم اضافة فئة جديدة'
                }
            }
        }
    }
};
