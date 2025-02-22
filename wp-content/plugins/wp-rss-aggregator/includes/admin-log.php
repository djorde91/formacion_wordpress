<?php

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use RebelCode\Wpra\Core\Logger\ClearableLoggerInterface;
use RebelCode\Wpra\Core\Logger\LogReaderInterface;

define('WPRSS_OPTION_CODE_LOG_LEVEL', 'log_level');
define('WPRSS_LOG_LEVEL_SYSTEM', LogLevel::DEBUG);
define('WPRSS_LOG_LEVEL_INFO', LogLevel::INFO);
define('WPRSS_LOG_LEVEL_NOTICE', LogLevel::NOTICE);
define('WPRSS_LOG_LEVEL_WARNING', LogLevel::WARNING);
define('WPRSS_LOG_LEVEL_ERROR', LogLevel::ERROR);

define('WPRSS_LOG_LEVEL_NONE', WPRSS_LOG_LEVEL_INFO);
define('WPRSS_LOG_LEVEL_DEFAULT', WPRSS_LOG_LEVEL_NONE);

/**
 * Returns the logger.
 *
 * @since 4.13
 *
 * @param int|string|null $feed_id Optional feed ID to retrieve the logger for that feed source.
 *
 * @return LoggerInterface|ClearableLoggerInterface|LogReaderInterface
 */
function wpra_get_logger($feed_id = null)
{
    if ($feed_id === null) {
        return wpra_container()->get('wpra/logging/logger');
    }

    $dataset = wpra_container()->get('wpra/logging/feed_logger_dataset');
    $logger = $dataset[$feed_id];

    return $logger;
}

/**
 * Reads a certain amount of data from the log file.
 *
 * By default, reads that data from the end of the file.
 *
 * @since 4.10
 *
 * @param null|int $length How many characters at most to read from the log.
 *                         Default: {@see WPRSS_LOG_DISPLAY_LIMIT}.
 * @param null|int $start  Position, at which to start reading.
 *                         If negative, represents that number of chars from the end.
 *                         Default: The amount of characters equal to $length away from the end of the file,
 *                         or the beginning of the file if the size of the file is less than or equal to $length.
 *
 * @return string|bool The content of the log, or false if the read operation failed.
 */
function wprss_log_read($length = null, $start = null)
{
    $logs = wpra_get_logger()->getLogs($length, $start);

    $output = '';
    foreach ($logs as $log) {
        $output .= sprintf('[%s] %s: %s', $log['date'], $log['level'], $log['message']) . PHP_EOL;
    }

    return $output;
}

/**
 * Returns the contents of the log file.
 *
 * @since 3.9.6
 */
function wprss_get_log()
{
    return wprss_log_read();
}

/**
 * Clears the log file.
 *
 * @since 3.9.6
 */
function wprss_clear_log()
{
    wpra_get_logger()->clearLogs();
}

/**
 * Alias for wprss_clear_log().
 *
 * Used for code readability.
 *
 * @since 3.9.6
 */
function wprss_reset_log()
{
    wprss_clear_log();
}

/**
 * Adds a log entry to the log file.
 *
 * @since 3.9.6
 */
function wprss_log($message, $src = null, $log_level = LogLevel::ERROR)
{
    wpra_get_logger()->log($log_level, $message);

    return;
}

/**
 * Dumps an object to the log file.
 *
 * @since 3.9.6
 */
function wprss_log_obj($message, $obj, $src = '', $log_level = LogLevel::ERROR)
{
    $message = sprintf('%s: %s', $message, print_r($obj, true));

    wprss_log($message, $src, $log_level);
}

/**
 * Downloads the log file.
 *
 * @since 4.7.8
 */
function wprss_download_log()
{
    $log = wprss_log_read();

    header('Content-Description: File Transfer');
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="error-log.txt"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($log));
    echo $log;
    exit;
}
