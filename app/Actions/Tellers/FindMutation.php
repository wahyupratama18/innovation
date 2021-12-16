<?php
namespace App\Actions\Tellers;

use App\Models\Mutation;
use DateTime;

/**
 * 
 */
trait FindMutation
{
    private static function splitter(int $id): object
    {
        return (object) [
            'date' => DateTime::createFromFormat('Ymd', substr($id, 0, 8)),
            'id' => substr($id, 8, 4)
        ];
    }

    public function finder(Mutation|int $id): Mutation
    {
        $split = $this->splitter($id);

        return Mutation::with('account.user')
        ->whereDate('updated_at', $split->date)
        ->findOrFail($split->id);
    }
}
