@props(['users', 'selectedUser', 'error' => false])
<select v-bind:class="{ 'form-select': true, 'is-invalid': error }" id="assigned_to" name="assigned_to">
    <option value="">Select User</option>
    @forelse($users as $user)
    <option v-for="user in users" :key="user.id" :value="user.id" v-bind:selected="user.id === selectedUser">
      {{ user.name }}
    </option>
    @empty
    <option v-if="!users.length" value="">No users found</option>
    @endforelse
</select>
