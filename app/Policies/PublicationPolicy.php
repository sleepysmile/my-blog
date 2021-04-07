<?php

namespace App\Policies;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublicationPolicy
{
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param int $publicationId
     * @return mixed
     */
    public function update(User $user, int $publicationId)
    {
        $publication = $this->findModel($publicationId);

        return $this->isCreatedBy($user, $publication);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param int $publicationId
     * @return mixed
     */
    public function edit(User $user, int $publicationId)
    {
        $publication = $this->findModel($publicationId);

        return $this->isCreatedBy($user, $publication);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Publication  $publication
     * @return mixed
     */
    public function delete(User $user, int $publicationId)
    {
        $publication = $this->findModel($publicationId);

        return $this->isCreatedBy($user, $publication);
    }

    /**
     * @param int $id
     * @return Publication
     */
    protected function findModel(int $id): Publication
    {
        $model = Publication::query()
            ->find($id)
            ->where('id', $id)
            ->first();

        if ($model === null) {
            throw new NotFoundHttpException('model not found');
        }

        return $model;
    }

    public function isCreatedBy(User $user, Publication $publication)
    {
        return (($user->id === $publication->created_by) && $user->isAdmin());
    }

}
