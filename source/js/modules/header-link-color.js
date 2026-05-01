/**
 * headerLinkColor ES Module
 * Sets class for header depending on text color class of the first block.
 */
export default function headerLinkColor() {
  const content = document.querySelector('.entry-content');
  const header = document.querySelector('.site-header');

  if (!content || !header) return;

  const firstChild = content.firstElementChild;

  // Verify the child exists and has the required base class
  if (firstChild && firstChild.classList.contains('content-section')) {
	
	// Check for the white color class
	if (firstChild.classList.contains('has-bith-white-color')) {
	  	header.classList.add('has-bith-white-color');
	}

	// Check for and remove the blue color class
	if (firstChild.classList.contains('has-bith-white-color') && header.classList.contains('has-bith-blue-color')) {
	  	header.classList.remove('has-bith-blue-color');
	}
  }
}
