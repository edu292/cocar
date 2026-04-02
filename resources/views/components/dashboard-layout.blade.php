<x-layout>
    <x-slot:body>
        <div class="dashboard-layout">
            <nav class="sidebar">
                <header class="sidebar__header">
                    <div class="logo">
                        <img
                            src="{{ asset('favicons/favicon.svg') }}"
                            alt="Logo CoCar"
                        />
                    </div>
                </header>
                <ul class="sidebar__list">
                    <li class="sidebar__list-item">
                        <a href="{{ route('admin-empresa.painel') }}" class="sidebar__link">
                            <div class="sidebar__link-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M22 3H2c-1.09.04-1.96.91-2 2v14c.04 1.09.91 1.96 2 2h20c1.09-.04 1.96-.91 2-2V5a2.074 2.074 0 0 0-2-2m0 16H2V5h20zm-8-2v-1.25c0-1.66-3.34-2.5-5-2.5s-5 .84-5 2.5V17zM9 7a2.5 2.5 0 0 0-2.5 2.5A2.5 2.5 0 0 0 9 12a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 9 7m5 0v1h6V7zm0 2v1h6V9zm0 2v1h4v-1z"
                                    />
                                </svg>
                            </div>
                            <span class="sidebar__link-text">Aprovações pendentes</span>
                        </a>
                    </li>
                    <li class="sidebar__list-item">
                        <a href="{{ route('admin-empresa.painel') }}" class="sidebar__link">
                            <div class="sidebar__link-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M24 14.6c0 .6-1.2 1-2.6 1.2c-.9-1.7-2.7-3-4.8-3.9c.2-.3.4-.5.6-.8h.8c3.1-.1 6 1.8 6 3.5M6.8 11H6c-3.1 0-6 1.9-6 3.6c0 .6 1.2 1 2.6 1.2c.9-1.7 2.7-3 4.8-3.9zm5.2 1c2.2 0 4-1.8 4-4s-1.8-4-4-4s-4 1.8-4 4s1.8 4 4 4m0 1c-4.1 0-8 2.6-8 5c0 2 8 2 8 2s8 0 8-2c0-2.4-3.9-5-8-5m5.7-3h.3c1.7 0 3-1.3 3-3s-1.3-3-3-3c-.5 0-.9.1-1.3.3c.8 1 1.3 2.3 1.3 3.7c0 .7-.1 1.4-.3 2M6 10h.3C6.1 9.4 6 8.7 6 8c0-1.4.5-2.7 1.3-3.7C6.9 4.1 6.5 4 6 4C4.3 4 3 5.3 3 7s1.3 3 3 3"
                                    />
                                </svg>
                            </div>
                            <span class="sidebar__link-text">Meus usuários</span>
                        </a>
                    </li>
                    <li class="sidebar__list-item">
                        <a href="{{ route('admin-empresa.painel') }}" class="sidebar__link">
                            <div class="sidebar__link-icon"></div>
                            <span class="sidebar__link-text">Meus benefícios</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <main class="dashboard-content">{{ $content }}</main>
        </div>
    </x-slot:body>
</x-layout>
