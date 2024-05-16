<?php

namespace App\Jobs;

use App\Models\FlashSaleItem;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductVariant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteExpireProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $thirtyDaysAgo = now()->subDays(30)->toDateTimeString();
        $products = Product::onlyTrashed()->where('deleted_at', '<', $thirtyDaysAgo)->get();
        $this->forceDelete($products);
    }

    //force delete trash____________________________________________________________
    public function forceDelete($products)
    {
        foreach ($products as $product) {
            $product->forceDelete();
            ProductImages::where('product_key', $product->product_key)->delete();
            FlashSaleItem::where('product_id', $product->id)->delete();
            ProductVariant::where('product_id', $product->id)->delete();
        }
    }
}
