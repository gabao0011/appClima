<div>
    <div class="d-flex min-vh-100" data-bs-theme="dark">

        {{-- Sidebar --}}
        <nav class="d-flex flex-column bg-dark border-end border-secondary p-3" style="width: 240px; min-height: 100vh;">
            <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                <h5 class="text-white fw-bold mb-0">GIE Dashboard</h5>
                <button class="btn btn-link text-secondary p-0 border-0">
                    <i class="bi bi-list fs-5"></i>
                </button>
            </div>

            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-bar-chart"></i> Monitoramento
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white bg-primary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-lightning"></i> Equipamentos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-wifi"></i> Sensores
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-people"></i> Tecnicos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-clipboard"></i> Ordens de Servico
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-person"></i> Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-secondary d-flex align-items-center gap-2 rounded-3 px-3 py-2">
                        <i class="bi bi-gear"></i> Configuracoes
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Main Content --}}
        <div class="flex-grow-1 bg-dark p-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="fw-bold text-white mb-1">Equipamentos</h2>
                    <p class="text-secondary mb-0">Gestao e monitoramento de equipamentos</p>
                </div>
                <a href="{{ route('equipamento.create') }}" class="btn btn-primary fw-medium px-4 py-2 rounded-3 border-0">
                    + Novo Equipamento
                </a>
            </div>

            {{-- Success Alert --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif

            {{-- Search and Filters --}}
            <div class="d-flex gap-3 mb-4">
                <div class="flex-grow-1">
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-secondary">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control bg-dark border-secondary text-white" placeholder="Buscar equipamentos..." wire:model.live="search">
                    </div>
                </div>
                <select class="form-select bg-dark border-secondary text-white" style="width: auto;" wire:model.live="filterStatus">
                    <option value="">Todos os Status</option>
                    <option value="operacional">Operacional</option>
                    <option value="atencao">Atencao</option>
                    <option value="manutencao">Manutencao</option>
                </select>
                <select class="form-select bg-dark border-secondary text-white" style="width: auto;" wire:model.live="filterTipo">
                    <option value="">Todos os Tipos</option>
                    @foreach ($equipamentos->pluck('tipo')->unique() as $tipo)
                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Stats Cards --}}
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card bg-dark border-secondary rounded-3">
                        <div class="card-body p-3">
                            <p class="text-secondary small mb-1">Total de Equipamentos</p>
                            <h3 class="fw-bold text-white mb-0">{{ $equipamentos->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-dark border-secondary rounded-3">
                        <div class="card-body p-3">
                            <p class="text-secondary small mb-1">Operacionais</p>
                            <h3 class="fw-bold text-success mb-0">{{ $equipamentos->where('status', 'operacional')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-dark border-secondary rounded-3">
                        <div class="card-body p-3">
                            <p class="text-secondary small mb-1">Requerem Atencao</p>
                            <h3 class="fw-bold text-warning mb-0">{{ $equipamentos->where('status', 'atencao')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-dark border-secondary rounded-3">
                        <div class="card-body p-3">
                            <p class="text-secondary small mb-1">Em Manutencao</p>
                            <h3 class="fw-bold text-danger mb-0">{{ $equipamentos->where('status', 'manutencao')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Equipment Table --}}
            <div class="card bg-dark border-secondary rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead>
                                <tr class="border-secondary">
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-4">Equipamento</th>
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-3">Localizacao</th>
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-3">Status</th>
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-3">Ultima Manutencao</th>
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-3">Proxima Manutencao</th>
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-3">Horas de Uso</th>
                                    <th class="text-secondary text-uppercase small fw-semibold py-3 px-3 text-center">Acoes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipamentos as $e)
                                <tr class="border-secondary">
                                    <td class="py-3 px-4">
                                        <div>
                                            <span class="fw-bold text-white">{{ $e->nome }}</span>
                                            <br>
                                            <small class="text-secondary">{{ $e->tipo }}</small>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 text-secondary">{{ $e->localizacao }}</td>
                                    <td class="py-3 px-3">
                                        @if ($e->status === 'operacional')
                                            <span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-2 small">
                                                <i class="bi bi-check-circle-fill me-1"></i> Operacional
                                            </span>
                                        @elseif ($e->status === 'atencao')
                                            <span class="badge bg-warning bg-opacity-25 text-warning rounded-pill px-3 py-2 small">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Atencao
                                            </span>
                                        @elseif ($e->status === 'manutencao')
                                            <span class="badge bg-danger bg-opacity-25 text-danger rounded-pill px-3 py-2 small">
                                                <i class="bi bi-tools me-1"></i> Manutencao
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3 text-secondary">
                                        {{ $e->ultima_manutencao ? \Carbon\Carbon::parse($e->ultima_manutencao)->format('d/m/Y') : '---' }}
                                    </td>
                                    <td class="py-3 px-3 text-secondary">
                                        {{ $e->proxima_manutencao ? \Carbon\Carbon::parse($e->proxima_manutencao)->format('d/m/Y') : '---' }}
                                    </td>
                                    <td class="py-3 px-3 text-secondary">
                                        {{ $e->horas_uso ? $e->horas_uso . 'h' : '---' }}
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('equipamento.edit', $e->id) }}" class="btn btn-link text-secondary p-1 border-0">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button
                                                class="btn btn-link text-danger p-1 border-0"
                                                wire:click="delete({{ $e->id }})"
                                                wire:confirm="Deseja realmente excluir este equipamento?">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
