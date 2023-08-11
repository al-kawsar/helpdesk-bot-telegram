<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script>
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

    // Function to add a new input field
    const addInputField = () => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = `
            <label class="block text-sm my-3">
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="kategori" />
            </label>
        `;

        alertPlaceholder.appendChild(wrapper);
    };

    // Attach event listener to the "Tambah Kolom" button
    const alertTrigger = document.getElementById('liveAlertBtn');
    if (alertTrigger) {
        alertTrigger.addEventListener('click', () => {
            addInputField();
        });
    }
</script>

</body>

</html>
