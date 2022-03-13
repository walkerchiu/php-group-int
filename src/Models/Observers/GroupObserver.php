<?php

namespace WalkerChiu\Group\Models\Observers;

class GroupObserver
{
    /**
     * Handle the entity "retrieved" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function retrieved($entity)
    {
        //
    }

    /**
     * Handle the entity "creating" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function creating($entity)
    {
        //
    }

    /**
     * Handle the entity "created" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function created($entity)
    {
        //
    }

    /**
     * Handle the entity "updating" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function updating($entity)
    {
        //
    }

    /**
     * Handle the entity "updated" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function updated($entity)
    {
        //
    }

    /**
     * Handle the entity "saving" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function saving($entity)
    {
        if (
            config('wk-core.class.group.group')
                ::where('id', '<>', $entity->id)
                ->where('host_type', $entity->host_type)
                ->where('host_id', $entity->host_id)
                ->where('identifier', $entity->identifier)
                ->exists()
        )
            return false;
    }

    /**
     * Handle the entity "saved" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function saved($entity)
    {
        //
    }

    /**
     * Handle the entity "deleting" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function deleting($entity)
    {
        //
    }

    /**
     * Handle the entity "deleted" event.
     *
     * Its Lang will be automatically removed by database.
     *
     * @param Entity  $entity
     * @return void
     */
    public function deleted($entity)
    {
        if (!config('php-group.soft_delete')) {
            $entity->forceDelete();
        }

        if ($entity->isForceDeleting()) {
            $entity->langs()->withTrashed()
                            ->forceDelete();
            if (
                config('wk-group.onoff.currency')
                && !empty(config('wk-core.class.currency.currency'))
            ) {
                $entity->currencies()->withTrashed()->delete();
            }
            if (
                config('wk-group.onoff.firewall')
                && !empty(config('wk-core.class.firewall.firewall'))
            ) {
                $entity->firewalls()->withTrashed()->delete();
            }
            if (
                config('wk-group.onoff.morph-address')
                && !empty(config('wk-core.class.morph-address.address'))
            ) {
                $entity->addresses()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.morph-board')
                && !empty(config('wk-core.class.morph-board.board'))
            ) {
                $entity->boards()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.morph-category')
                && !empty(config('wk-core.class.morph-category.category'))
            ) {
                $entity->categories()->detach();
            }
            if (
                config('wk-group.onoff.morph-comment')
                && !empty(config('wk-core.class.morph-comment.comment'))
            ) {
                $entity->comments()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.morph-image')
                && !empty(config('wk-core.class.morph-image.image'))
            ) {
                $entity->images()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.morph-registration')
                && !empty(config('wk-core.class.morph-registration.registration'))
            ) {
                $entity->registrations()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.morph-tag')
                && !empty(config('wk-core.class.morph-tag.tag'))
                && is_iterable($entity->tags())
            ) {
                $entity->tags()->detach();
            }
            if (
                config('wk-group.onoff.morph-link')
                && !empty(config('wk-core.class.morph-link.link'))
            ) {
                $entity->links()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.newsletter')
                && !empty(config('wk-core.class.newsletter.article'))
            ) {
                $entity->newsletters()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.payment')
                && !empty(config('wk-core.class.payment.payment'))
            ) {
                $entity->payments()->withTrashed()->forceDelete();
            }
            if (
                config('wk-group.onoff.role')
                && !empty(config('wk-core.class.role.role'))
            ) {
                $entity->roles()->withTrashed()->forceDelete();
            }
        }
    }

    /**
     * Handle the entity "restoring" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function restoring($entity)
    {
        if (
            config('wk-core.class.group.group')
                ::where('id', '<>', $entity->id)
                ->where('host_type', $entity->host_type)
                ->where('host_id', $entity->host_id)
                ->where('identifier', $entity->identifier)
                ->exists()
        )
            return false;
    }

    /**
     * Handle the entity "restored" event.
     *
     * @param Entity  $entity
     * @return void
     */
    public function restored($entity)
    {
        //
    }
}
