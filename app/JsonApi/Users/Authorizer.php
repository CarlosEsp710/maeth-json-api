<?php

namespace App\JsonApi\Users;

use CloudCreativity\LaravelJsonApi\Auth\AbstractAuthorizer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Authorizer extends AbstractAuthorizer
{
    protected $guards = ['sanctum'];

    /**
     * Authorize a resource index request.
     *
     * @param string $type
     *      the domain record type.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function index($type, $request)
    {
        $this->can('index', $type, $request);
    }

    /**
     * Authorize a resource create request.
     *
     * @param string $type
     *      the domain record type.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function create($type, $request)
    {
        $this->can('create', $type, $request);
    }

    /**
     * Authorize a resource read request.
     *
     * @param object $record
     *      the domain record.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function read($user, $request)
    {
        $this->can('read', $user);
    }

    /**
     * Authorize a resource update request.
     *
     * @param object $record
     *      the domain record.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function update($user, $request)
    {
        $this->can('update', $user);
    }

    /**
     * Authorize a resource read request.
     *
     * @param object $record
     *      the domain record.
     * @param Request $request
     *      the inbound request.
     * @return void
     * @throws AuthenticationException|AuthorizationException
     *      if the request is not authorized.
     */
    public function delete($user, $request)
    {
        $this->can('delete', $user);
    }
}
