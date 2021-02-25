<?php


namespace Medine\ERP\Provider\Infrastructure\Persistence;


use Illuminate\Support\Facades\DB;
use Medine\ERP\Provider\Domain\Entity\Provider;
use Medine\ERP\Provider\Domain\ProviderRepositoy;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderCreatedAt;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderUpdatedAt;

class MySqlProviderRepository implements ProviderRepositoy
{
    public function save(Provider $provider): void
    {
        DB::table('provider')->insert([
            'id' => $provider->id()->value(),
            'name' => $provider->name()->value(),
            'created_at' => $provider->createdAt()->value(),
            'updated_at' => $provider->updatedAt()->value()
        ]);
    }


    public function update(Provider $provider): void
    {
        DB::table('provider')->where('provider.id', $provider->id()->value())->take(1)->update([
            'id' => $provider->id()->value(),
            'name' => $provider->name()->value(),
            'created_at' => $provider->createdAt()->value(),
            'updated_at' => $provider->updatedAt()->value()
        ]);
    }

    public function find(ProviderId $id): ?Provider
    {
        $provider = DB::table('provider')->where('provider.id', $id->value())->first();

        return !empty($provider) ?  Provider::fromDatabase(
            new ProviderId($provider->id),
            new ProviderName($provider->name),
            new ProviderCreatedAt($provider->created_at),
            new ProviderUpdatedAt($provider->updated_at)
        ) : null;
    }

}
