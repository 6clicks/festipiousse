document.querySelectorAll('.wp-block-button__link').forEach(btn => {
	btn.addEventListener('mouseenter', function () {
		for (let i = 0; i < 8; i++) {
			setTimeout(() => {
				const bubble = document.createElement('span');
				bubble.classList.add('btn-bubble');
				const size = Math.random() * 20 + 6;
				bubble.style.cssText = `
					width: ${size}px;
					height: ${size}px;
					left: ${Math.random() * 90 + 5}%;
					animation-duration: ${Math.random() * 0.4 + 0.5}s;
					animation-delay: ${Math.random() * 0.2}s;
				`;
				btn.appendChild(bubble);
				bubble.addEventListener('animationend', () => bubble.remove());
			}, i * 60);
		}
	});
});
