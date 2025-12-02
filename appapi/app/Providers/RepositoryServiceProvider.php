<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Repository Contracts
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ContractRepositoryInterface;
use App\Repositories\Contracts\WorksheetRepositoryInterface;
use App\Repositories\Contracts\SheetGroupRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Contracts\VendorTypeRepositoryInterface;
use App\Repositories\Contracts\UomRepositoryInterface;
use App\Repositories\Contracts\RefftypeRepositoryInterface;
use App\Repositories\Contracts\ContractSheetRepositoryInterface;

// Repository Implementations
use App\Repositories\ProjectRepository;
use App\Repositories\ContractRepository;
use App\Repositories\WorksheetRepository;
use App\Repositories\SheetGroupRepository;
use App\Repositories\VendorRepository;
use App\Repositories\VendorTypeRepository;
use App\Repositories\UomRepository;
use App\Repositories\RefftypeRepository;
use App\Repositories\ContractSheetRepository;

// Models
use App\Project;
use App\Contract;
use App\Worksheet;
use App\SheetGroup;
use App\Vendor;
use App\VendorType;
use App\Uom;
use App\Refftype;
use App\ContractSheet;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Project Repository Binding
        $this->app->bind(ProjectRepositoryInterface::class, function ($app) {
            return new ProjectRepository(new Project());
        });

        // Contract Repository Binding
        $this->app->bind(ContractRepositoryInterface::class, function ($app) {
            return new ContractRepository(new Contract());
        });

        // Worksheet Repository Binding
        $this->app->bind(WorksheetRepositoryInterface::class, function ($app) {
            return new WorksheetRepository(new Worksheet());
        });

        // SheetGroup Repository Binding
        $this->app->bind(SheetGroupRepositoryInterface::class, function ($app) {
            return new SheetGroupRepository(new SheetGroup());
        });

        // Vendor Repository Binding
        $this->app->bind(VendorRepositoryInterface::class, function ($app) {
            return new VendorRepository(new Vendor());
        });

        // VendorType Repository Binding
        $this->app->bind(VendorTypeRepositoryInterface::class, function ($app) {
            return new VendorTypeRepository(new VendorType());
        });

        // Uom Repository Binding
        $this->app->bind(UomRepositoryInterface::class, function ($app) {
            return new UomRepository(new Uom());
        });

        // Refftype Repository Binding
        $this->app->bind(RefftypeRepositoryInterface::class, function ($app) {
            return new RefftypeRepository(new Refftype());
        });

        // ContractSheet Repository Binding
        $this->app->bind(ContractSheetRepositoryInterface::class, function ($app) {
            return new ContractSheetRepository(new ContractSheet());
        });
    }

    public function boot()
    {
        //
    }
}
