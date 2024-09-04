document.getElementById('profile-button').addEventListener('click', function() {
    var profileDetails = document.getElementById('profile-details');
    if (profileDetails.classList.contains('hidden')) {
        profileDetails.classList.remove('hidden');
        this.textContent = 'Hide Profile';
    } else {
        profileDetails.classList.add('hidden');
        this.textContent = 'Show Profile';
    }
});
