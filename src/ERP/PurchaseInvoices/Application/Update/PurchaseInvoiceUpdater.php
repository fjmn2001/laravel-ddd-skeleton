<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Application\Update;

use Medine\ERP\PurchaseInvoices\Application\PurchaseInvoiceResponse;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceRepository;
use Medine\ERP\PurchaseInvoices\Domain\Service\PurchaseInvoiceFinder;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceAccountsPayId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceCode;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceDiscount;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceIssueDate;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceObservations;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoicePaymentTerm;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceProviderId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceReference;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceState;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceSubtotal;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceTax;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceTotal;

final class PurchaseInvoiceUpdater
{
    private $finder;
    private $repository;

    public function __construct(PurchaseInvoiceFinder $finder, PurchaseInvoiceRepository $repository)
    {
        $this->finder = $finder;
        $this->repository = $repository;
    }

    public function __invoke(PurchaseInvoiceUpdaterRequest $request)
    {
        $purchaseInvoice = ($this->finder)(new PurchaseInvoiceId($request->id()));
        $purchaseInvoice->changeProviderId(new PurchaseInvoiceProviderId($request->providerId()));
        $purchaseInvoice->changePaymentTerm(new PurchaseInvoicePaymentTerm($request->paymentTerm()));
        $purchaseInvoice->changeCode(new PurchaseInvoiceCode($request->code()));
        $purchaseInvoice->changeIssueDate(new PurchaseInvoiceIssueDate(
            \DateTimeImmutable::createFromFormat('d/m/Y', $request->issueDate())->format('Y-m-d H:i:s')
        ));
        $purchaseInvoice->changeAccountsPayId(new PurchaseInvoiceAccountsPayId($request->accountsPayId()));
//        $purchaseInvoice->changeReference(new PurchaseInvoiceReference($request->reference()));
//        //todo: $purchaseInvoice->changeState(new PurchaseInvoiceState($request->state()));
//        $purchaseInvoice->changeObservations(new PurchaseInvoiceObservations($request->observations()));
//        $purchaseInvoice->changeSubtotal(new PurchaseInvoiceSubtotal($request->subtotal()));
//        $purchaseInvoice->changeDiscount(new PurchaseInvoiceDiscount($request->discount()));
//        $purchaseInvoice->changeTax(new PurchaseInvoiceTax($request->tax()));
//        $purchaseInvoice->changeTotal(new PurchaseInvoiceTotal($request->total()));
//        $purchaseInvoice->changeItems($request->items());
        $this->repository->update($purchaseInvoice);
    }
}
