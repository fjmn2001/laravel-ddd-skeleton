<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');

            $table->string('provider_id');
            $table->index('provider_id');

            $table->string('payment_term');
            $table->index('payment_term');

            $table->string('code');
            $table->index('code');

            $table->dateTime('issue_date');

            $table->string('accounts_pay_id');
            $table->string('reference')->nullable();

            $table->string('state');
            $table->index('state');

            $table->text('observations')->nullable();

            $table->float('subtotal', 10);
            $table->float('discount', 10);
            $table->float('tax', 10);
            $table->float('total', 10);

            $table->string('company_id');
            $table->index('company_id');

            $table->timestamps();
        });

        Schema::create('purchase_invoice_items', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');

            $table->string('category_id');
            $table->index('category_id');

            $table->string('item_id');
            $table->index('item_id');

            $table->float('quantity', 10);

            $table->string('unit_id');
            $table->index('unit_id');

            $table->float('unit_price', 10);
            $table->float('subtotal', 10);

            $table->string('tax_id');
            $table->index('tax_id');

            $table->float('discount_rate', 10);

            $table->string('accounting_center_id');
            $table->index('accounting_center_id');

            $table->string('account_id');
            $table->index('account_id');

            $table->string('location_id')->nullable();
            $table->index('location_id');

            $table->string('purchase_invoice_id');
            $table->index('purchase_invoice_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_invoice_items');
        Schema::dropIfExists('purchase_invoices');
    }
}
