<?php

namespace Dreamon\DevTool\Providers;

use Dreamon\Base\Supports\ServiceProvider;
use Dreamon\DevTool\Commands\LocaleCreateCommand;
use Dreamon\DevTool\Commands\LocaleRemoveCommand;
use Dreamon\DevTool\Commands\Make\ControllerMakeCommand;
use Dreamon\DevTool\Commands\Make\FormMakeCommand;
use Dreamon\DevTool\Commands\Make\ModelMakeCommand;
use Dreamon\DevTool\Commands\Make\PanelSectionMakeCommand;
use Dreamon\DevTool\Commands\Make\RequestMakeCommand;
use Dreamon\DevTool\Commands\Make\RouteMakeCommand;
use Dreamon\DevTool\Commands\Make\SettingControllerMakeCommand;
use Dreamon\DevTool\Commands\Make\SettingFormMakeCommand;
use Dreamon\DevTool\Commands\Make\SettingMakeCommand;
use Dreamon\DevTool\Commands\Make\SettingRequestMakeCommand;
use Dreamon\DevTool\Commands\Make\TableMakeCommand;
use Dreamon\DevTool\Commands\PackageCreateCommand;
use Dreamon\DevTool\Commands\PackageMakeCrudCommand;
use Dreamon\DevTool\Commands\PackageRemoveCommand;
use Dreamon\DevTool\Commands\PluginCreateCommand;
use Dreamon\DevTool\Commands\PluginMakeCrudCommand;
use Dreamon\DevTool\Commands\RebuildPermissionsCommand;
use Dreamon\DevTool\Commands\TestSendMailCommand;
use Dreamon\DevTool\Commands\ThemeCreateCommand;
use Dreamon\DevTool\Commands\WidgetCreateCommand;
use Dreamon\DevTool\Commands\WidgetRemoveCommand;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            TableMakeCommand::class,
            ControllerMakeCommand::class,
            RouteMakeCommand::class,
            RequestMakeCommand::class,
            FormMakeCommand::class,
            ModelMakeCommand::class,
            PackageCreateCommand::class,
            PackageMakeCrudCommand::class,
            PackageRemoveCommand::class,
            TestSendMailCommand::class,
            RebuildPermissionsCommand::class,
            LocaleRemoveCommand::class,
            LocaleCreateCommand::class,
        ]);

        if (version_compare(get_core_version(), '7.0.0', '>=')) {
            $this->commands([
                PanelSectionMakeCommand::class,
                SettingControllerMakeCommand::class,
                SettingRequestMakeCommand::class,
                SettingFormMakeCommand::class,
                SettingMakeCommand::class,
            ]);
        }

        if (class_exists(\Dreamon\PluginManagement\Providers\PluginManagementServiceProvider::class)) {
            $this->commands([
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }

        if (class_exists(\Dreamon\Theme\Providers\ThemeServiceProvider::class)) {
            $this->commands([
                ThemeCreateCommand::class,
            ]);
        }

        if (class_exists(\Dreamon\Widget\Providers\WidgetServiceProvider::class)) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
