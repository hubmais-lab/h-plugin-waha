<?php
declare(strict_types=1);

namespace Hubmais\HPluginWaha\Services;

use Hubmais\HPluginWaha\Support\AbstractService;

class GroupService extends AbstractService
{
    function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $sortBy = null,
        ?string $sortOrder = null,
        ?array $exclude = null,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups", compact('limit', 'offset', 'sortBy', 'sortOrder', 'exclude'));
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function store(
        string $name,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups", compact('name', 'participants'));
    }

    function joinInfo(
        string $code,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/join-info", compact('code'));
    }

    function join(
        string $code,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/join", compact('code'));
    }

    function count(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/count");
    }

    function refresh(
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/refresh");
    }

    function show(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}");
    }

    function destroy(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/groups/{$id}");
    }

    function leave(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/leave");
    }

    function picture(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/picture");
    }

    /**
     * @param array{mimetype:string,filename:string,url:string} $file
     */
    function updatePicture(
        string $id,
        array $file,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/picture", compact('file'));
    }

    function destroyPicture(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->delete("/api/{$session}/groups/{$id}/picture");
    }

    function description(
        string $id,
        string $description,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/description", compact('description'));
    }

    function subject(
        string $id,
        string $subject,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/subject", compact('subject'));
    }

    function infoAdminOnly(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/settings/security/info-admin-only");
    }

    function updateInfoAdminOnly(
        string $id,
        bool $adminsOnly = true,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/settings/security/info-admin-only", compact('adminsOnly'));
    }

    function messageAdminOnly(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/settings/security/message-admin-only");
    }

    function updateMessageAdminOnly(
        string $id,
        bool $adminsOnly = true,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/settings/security/message-admin-only", compact('adminsOnly'));
    }

    function memberAddMode(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/settings/security/member-add-mode");
    }

    function updateMemberAddMode(
        string $id,
        bool $membersCanAddNewMember = true,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/settings/security/member-add-mode", compact('membersCanAddNewMember'));
    }

    function membershipApproval(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/settings/security/membership-approval");
    }

    function udpateMembershipApproval(
        string $id,
        bool $newMembersApprovalRequired = false,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->put("/api/{$session}/groups/{$id}/settings/security/membership-approval", compact('newMembersApprovalRequired'));
    }

    function joinRequests(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/participants/join-requests");
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function joinRequestsApprove(
        string $id,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/participants/join-requests/approve", compact('participants'));
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function joinRequestsReject(
        string $id,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/participants/join-requests/reject", compact('participants'));
    }

    function inviteCode(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/invite-code");
    }

    function inviteCodeRevoke(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/invite-code/revoke");
    }

    function participants(
        string $id,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->get("/api/{$session}/groups/{$id}/participants/v2");
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function participatsAdd(
        string $id,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/participants/add", compact('participants'));
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function participatsRevoke(
        string $id,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/participants/revoke", compact('participants'));
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function adminPromote(
        string $id,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/admin/promote", compact('participants'));
    }

    /**
     * @param list<array{id:string}> $participants
     */
    function adminDemote(
        string $id,
        array $participants,
        ?string $session = null
    )
    {
        if(empty($session))
            $session = $this->getSession();

        return $this->client->post("/api/{$session}/groups/{$id}/admin/demote", compact('participants'));
    }
}