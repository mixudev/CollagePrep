// Sync color picker with text input
document.addEventListener('DOMContentLoaded', function() {
    const colorInputs = document.querySelectorAll('input[type="color"]');
    
    colorInputs.forEach(colorInput => {
        const textInput = colorInput.parentElement.querySelector('input[type="text"]');
        
        if (textInput) {
            // Sync color picker to text input
            colorInput.addEventListener('input', function() {
                textInput.value = this.value;
            });
            
            // Sync text input to color picker
            textInput.addEventListener('input', function() {
                if (/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(this.value)) {
                    colorInput.value = this.value;
                }
            });
        }
    });
});

