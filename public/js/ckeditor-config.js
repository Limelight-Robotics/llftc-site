// CKEditor 5 Configuration for Dark Theme
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking for CKEditor...');
    
    if (typeof CKEDITOR === 'undefined') {
        console.error('CKEditor not loaded');
        return;
    }

    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Font,
        Paragraph,
        Link,
        List,
        Heading,
        BlockQuote,
        Code,
        CodeBlock
    } = CKEDITOR;

    // Function to initialize CKEditor on a specific element
    function initializeCKEditor(element) {
        if (!element || element.dataset.ckeditorInitialized) {
            return; // Already initialized or element doesn't exist
        }

        ClassicEditor
            .create(element, {
                plugins: [Essentials, Bold, Italic, Font, Paragraph, Link, List, Heading, BlockQuote, Code, CodeBlock],
                toolbar: [
                    'heading', '|',
                    'undo', 'redo', '|', 
                    'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|',
                    'blockQuote', 'code', 'codeBlock', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                console.log('CKEditor 5 initialized successfully on element:', element.id);
                
                // Mark as initialized
                element.dataset.ckeditorInitialized = 'true';
                
                // Set initial content from textarea if any (for edit forms)
                const textareaContent = element.value;
                if (textareaContent) {
                    editor.setData(textareaContent);
                }
                
                // Hide the original textarea
                element.style.display = 'none';
                
                // Update textarea on editor change
                editor.model.document.on('change:data', () => {
                    element.value = editor.getData();
                });
                
                // Store editor instance for cleanup if needed
                element.ckeditorInstance = editor;
            })
            .catch(error => {
                console.error('CKEditor 5 error:', error);
                // Fall back to plain textarea if editor fails
                element.style.display = 'block';
            });
    }

    // Initialize CKEditor on all content textareas
    const contentTextareas = document.querySelectorAll('#content');
    contentTextareas.forEach(initializeCKEditor);

    // Watch for dynamically added content textareas
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Element node
                    const contentTextarea = node.querySelector ? node.querySelector('#content') : null;
                    if (contentTextarea) {
                        initializeCKEditor(contentTextarea);
                    }
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});
