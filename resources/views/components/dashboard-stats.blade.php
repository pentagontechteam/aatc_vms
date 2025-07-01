<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">

    <x-staff-stat-card
        title="Total Invitations"
        :value="$stats['totalInvitations']"
        :percentage="$stats['percentageTotalInvitations']"
        icon="fas fa-users"
        bg-color="bg-[#feca01]"
        text-color="text-gray-900"
        icon-color="text-orange-600"
        percentage-type="normal"
    />

    <x-staff-stat-card
        title="Approved Today"
        :value="$stats['approvedToday']"
        :percentage="$stats['percentageApproved']"
        icon="fas fa-check-circle"
        bg-color="bg-[#16af8b]"
        text-color="text-white"
        icon-color="text-white"
        percentage-type="normal"
    />

    <x-staff-stat-card
        title="Pending Approval"
        :value="$stats['pendingApproval']"
        :percentage="$stats['percentagePendingApproval']"
        icon="fas fa-clock"
        bg-color="bg-yellow-500"
        text-color="text-white"
        icon-color="text-white"
        percentage-type="neutral"
    />

    <x-staff-stat-card
        title="Cancelled/Denied"
        :value="$stats['denied']"
        :percentage="$stats['percentageDenied']"
        icon="fas fa-times-circle"
        bg-color="bg-[#6c757d]"
        text-color="text-white"
        icon-color="text-white"
        percentage-type="inverse"
    />

</div>
