## Install

```bash
composer require componentsv/dblog
```

### Add into service provider array in ./config/app.php

```php
'providers' => [
        // Component
        App\Components\DBLog\Providers\DBLogServiceProvider::class,

    ],
```

## Optional : Publish config (Onsigbaar framework only)

```bash
php artisan component:publish-config DBLog
```

## Fire events basic

### Emergency
```php
\Event::fire('event.emergency', [['message' => $message]]);
```

### Alert
```php
\Event::fire('event.alert', [['message' => $message]]);
```

### Critical
```php
\Event::fire('event.critical', [['message' => $message]]);
```

### Error
```php
\Event::fire('event.error', [['message' => $param['e']->getMessage()]]); // use try - catch to get error message
```

### Warning
```php
\Event::fire('event.warning', [['message' => $message]]);
```

### Notice
```php
\Event::fire('event.notice', [['message' => $message]]);
```

### Info
```php
\Event::fire('event.info', [['message' => $message]]);
```

### Debug
```php
\Event::fire('event.debug', [['message' => $message]]);
```

## Fire events using default config example
Event should be wrapped in an configuration variable array, example of firing events using default package config.

### Emergency
```php
if ((config('dblog.logActivity')) && (config('dblog.emergency'))) {
    \Event::fire('event.emergency', [['message' => $message]]);
}
```

### Alert
```php
if ((config('dblog.logActivity')) && (config('dblog.alert'))) {
    \Event::fire('event.alert', [['message' => $message]]);
}
```

### Critical
```php
if ((config('dblog.logActivity')) && (config('dblog.critical'))) {
    \Event::fire('event.critical', [['message' => $message]]);
}
```

### Error
```php
if ((config('dblog.logActivity')) && (config('dblog.error'))) {
    \Event::fire('event.error', [['message' => $param['e']->getMessage()]]);
}
```

### Warning
```php
if ((config('dblog.logActivity')) && (config('dblog.warning'))) {
    \Event::fire('event.warning', [['message' => $message]]);
}
```

### Notice
```php
if ((config('dblog.logActivity')) && (config('dblog.notice'))) {
    \Event::fire('event.notice', [['message' => $message]]);
}
```

### Info
```php
if ((config('dblog.logActivity')) && (config('dblog.info'))) {
    \Event::fire('event.info', [['message' => $message]]);
}
```

### Debug
```php
if ((config('dblog.logActivity')) && (config('dblog.debug'))) {
    if (isset($param['construct'])) {
        $query      = $construct->toSql();
        $queryCount = $construct->count();

        \Event::fire('event.debug', [
            ['message' => 'Success get data from ' . $table . ' table, count records "' . $queryCount . '", with query : "' . $query . '"']
        ]);
    } else {
        \Event::fire('event.debug', [['message' => $message]]);
    }
}
```

## Fire events using wrapper 

Example in model class

```php
use App\Components\DBLog\Traits\DBLog;

class BaseModel extends Model
{
    use DBLog;

    protected $fillable = [];
}
```

Event wrapper

```php
# Emergency
$this->fireLog('emergencyOrError', $message, ['somethingElse' => $something]);

# Alert
$this->fireLog('alertOrError', $message, []);

# Critical
$this->fireLog('criticalOrError', $message);

# Error
$this->fireLog('error', $e->getMessage());

# Warning
$this->fireLog('warningOrError', $message);

# Notice
$this->fireLog('noticeOrError', $message);

# Info
$this->fireLog('infoOrError', $message);

# Debug
$this->fireLog('debugOrError', $message);
```