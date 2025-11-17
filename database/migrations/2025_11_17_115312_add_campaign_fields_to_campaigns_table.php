<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCampaignFieldsToCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('zalo_phone')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('campaign_area')->nullable();
            $table->string('campaign_image')->nullable();
            $table->enum('priority_content_type', ['no_priority', 'regular_review', 'video_sales', 'live_sales'])->default('no_priority');
            $table->text('sales_link')->nullable();
            $table->boolean('free_sample_order')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn([
                'zalo_phone',
                'fb_link',
                'campaign_area',
                'campaign_image',
                'priority_content_type',
                'sales_link',
                'free_sample_order'
            ]);
        });
    }
}
