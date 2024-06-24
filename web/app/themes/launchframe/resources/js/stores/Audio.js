export default () => {
    Alpine.store('audioMute', false) // User Toggled & Persisted
    Alpine.store('audioPause', false)
    document.addEventListener('visibilitychange', () => {
        Alpine.store('audioPause', document.hidden)
    })
}
