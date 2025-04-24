<?php

/**
 * constants-upload.php
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

// DIR, File
define('PERMISSION_DIR', 0775);
define('PERMISSION_FILE', 0775);

// Image/File Uploads
define('STORAGE_DIR_NAME', 'storage');
define('APP_STORAGE_PATH', 'app' . DS . 'public' . DS);

// Default values
define('UPLOAD_FILE_DIR_NAME_TMP', 'tmp');
define('UPLOAD_FILE_DIR_NAME', 'uploads');
define('UPLOAD_FILE_PATH', APP_STORAGE_PATH . UPLOAD_FILE_DIR_NAME);
define('UPLOAD_FILE_MAX_SIZE', 2000);
define('UPLOAD_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Album Module
define('ALBUM_FILE_DIR_NAME', 'album');
define('ALBUM_FILE_PATH', APP_STORAGE_PATH . ALBUM_FILE_DIR_NAME);
define('ALBUM_FILE_MAX_SIZE', 2000);
define('ALBUM_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Blog Category Module
define('BLOG_CATEGORY_FILE_DIR_NAME', 'blogcategory');
define('BLOG_CATEGORY_FILE_PATH', APP_STORAGE_PATH . BLOG_CATEGORY_FILE_DIR_NAME);
define('BLOG_CATEGORY_FILE_MAX_SIZE', 2000);
define('BLOG_CATEGORY_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Blog Module
define('BLOG_FILE_DIR_NAME', 'blog');
define('BLOG_FILE_PATH', APP_STORAGE_PATH . BLOG_FILE_DIR_NAME);
define('BLOG_FILE_MAX_SIZE', 2000);
define('BLOG_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// BANNER Module
define('BANNER_FILE_DIR_NAME', 'banner');
define('BANNER_FILE_PATH', APP_STORAGE_PATH . BANNER_FILE_DIR_NAME);
define('BANNER_FILE_MAX_SIZE', 2000);
define('BANNER_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// FAQ Module
define('FAQ_FILE_DIR_NAME', 'faq');
define('FAQ_FILE_PATH', APP_STORAGE_PATH . FAQ_FILE_DIR_NAME);
define('FAQ_FILE_MAX_SIZE', 2000);
define('FAQ_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// FAQ Category Module
define('FAQ_CATEGORY_FILE_DIR_NAME', 'faqCategory');
define('FAQ_CATEGORY_FILE_PATH', APP_STORAGE_PATH . FAQ_CATEGORY_FILE_DIR_NAME);
define('FAQ_CATEGORY_FILE_MAX_SIZE', 2000);
define('FAQ_CATEGORY_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Page Module
define('PAGE_FILE_DIR_NAME', 'page');
define('PAGE_FILE_PATH', APP_STORAGE_PATH . PAGE_FILE_DIR_NAME);
define('PAGE_FILE_MAX_SIZE', 2000);
define('PAGE_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// News Category Module
define('NEWS_CATEGORY_FILE_DIR_NAME', 'newscategory');
define('NEWS_CATEGORY_FILE_PATH', APP_STORAGE_PATH . NEWS_CATEGORY_FILE_DIR_NAME);
define('NEWS_CATEGORY_FILE_MAX_SIZE', 2000);
define('NEWS_CATEGORY_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// NEWS Module
define('NEWS_FILE_DIR_NAME', 'news');
define('NEWS_FILE_PATH', APP_STORAGE_PATH . NEWS_FILE_DIR_NAME);
define('NEWS_FILE_MAX_SIZE', 2000);
define('NEWS_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Post Module
define('POST_FILE_DIR_NAME', 'post');
define('POST_FILE_PATH', APP_STORAGE_PATH . POST_FILE_DIR_NAME);
define('POST_FILE_MAX_SIZE', 2000);
define('POST_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Post Category Module
define('POST_CATEGORY_FILE_DIR_NAME', 'postCategory');
define('POST_CATEGORY_FILE_PATH', APP_STORAGE_PATH . POST_CATEGORY_FILE_DIR_NAME);
define('POST_CATEGORY_FILE_MAX_SIZE', 2000);
define('POST_CATEGORY_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// SITE SETTING Module
define('SITE_SETTING_FILE_DIR_NAME', 'siteSetting');
define('SITE_SETTING_FILE_PATH', APP_STORAGE_PATH . SITE_SETTING_FILE_DIR_NAME);
define('SITE_SETTING_FILE_MAX_SIZE', 2000);
define('SITE_SETTING_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Testimonial Module
define('TESTIMONIAL_FILE_DIR_NAME', 'testimonial');
define('TESTIMONIAL_FILE_PATH', APP_STORAGE_PATH . TESTIMONIAL_FILE_DIR_NAME);
define('TESTIMONIAL_FILE_MAX_SIZE', 2000);
define('TESTIMONIAL_FILE_DIMENSIONS', json_encode(['200', '800', '1200']));

// Resource  Module
define('RESOURCE_FILE_DIR_NAME', 'resource');
define('RESOURCE_FILE_PATH', APP_STORAGE_PATH . RESOURCE_FILE_DIR_NAME);
define('RESOURCE_FILE_MAX_SIZE', 2000);
define('RESOURCE_FILE_ALLOWED_TYPES', ['pdf', 'doc', 'docx']);


define('NON_RESIZABLE_TYPES', ['svg', 'gif']);
