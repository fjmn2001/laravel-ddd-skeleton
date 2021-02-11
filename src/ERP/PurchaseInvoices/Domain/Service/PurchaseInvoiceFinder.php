<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain\Service;

use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoice;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceRepository;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;

final class PurchaseInvoiceFinder
{
    private $repository;

    public function __construct(PurchaseInvoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PurchaseInvoiceId $id): PurchaseInvoice
    {
        $purchaseInvoice = $this->repository->find($id);

        if (null === $purchaseInvoice) {
            throw new PurchaseInvoiceNotExistsException($id);
        }

        return $purchaseInvoice;
    }
}
