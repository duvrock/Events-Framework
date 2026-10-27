<section class="admin-page" id="overview">
    <div class="admin-page-heading">
        <div>
            <p class="eyebrow"><span class="eyebrow-line"></span> Panou de administrare</p>
            <h1>Prezentare generală</h1>
            <p class="admin-description">Gestionează conținutul și urmărește solicitările primite.</p>
        </div>
        <a class="button admin-primary-action" href="/#servicii" target="_blank" rel="noopener">Vezi site-ul <span aria-hidden="true">↗</span></a>
    </div>

    <div class="admin-stats">
        <article class="admin-stat-card">
            <span class="admin-stat-icon" aria-hidden="true">▤</span>
            <span class="admin-stat-label">Pagini administrabile</span>
            <strong><?= count($data['pages']) ?></strong>
            <span class="admin-stat-note">Conținut disponibil pentru editare</span>
        </article>
        <article class="admin-stat-card">
            <span class="admin-stat-icon" aria-hidden="true">✉</span>
            <span class="admin-stat-label">Solicitări recente</span>
            <strong><?= count($data['requests']) ?></strong>
            <span class="admin-stat-note">Afișate în lista de mai jos</span>
        </article>
    </div>

    <div class="admin-panel" id="pages">
        <div class="admin-panel-heading">
            <div>
                <h2>Pagini site</h2>
                <p class="admin-panel-description">Editează titlurile și textele principale.</p>
            </div>
            <span class="admin-panel-count"><?= count($data['pages']) ?> pagini</span>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr><th>Pagina</th><th>URL</th><th>Ultima modificare</th><th></th></tr>
                </thead>
                <tbody>
                    <?php foreach ($data['pages'] as $page): ?>
                        <tr>
                            <td><?= e($page['title']) ?></td>
                            <td><code><?= $page['slug'] === 'home' ? '/' : '/' . e($page['slug']) . '/' ?></code></td>
                            <td><?= e($page['updated_at']) ?></td>
                            <td><a class="text-link" href="/admin/pages/<?= e($page['slug']) ?>/">Editează</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-panel" id="requests">
        <div class="admin-panel-heading">
            <div>
                <h2>Solicitări recente</h2>
                <p class="admin-panel-description">Cele mai noi mesaje trimise prin formularul de contact.</p>
            </div>
        </div>
        <?php if ($data['requests'] === []): ?>
            <p class="admin-description">Momentan nu există solicitări salvate.</p>
        <?php else: ?>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr><th>Data</th><th>Nume</th><th>Telefon</th><th>Eveniment</th><th>Serviciu</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['requests'] as $request): ?>
                            <tr>
                                <td><?= e($request['submitted_at']) ?></td>
                                <td><?= e($request['name']) ?></td>
                                <td><?= e($request['phone']) ?></td>
                                <td><?= e($request['event_type']) ?></td>
                                <td><?= e($request['desired_service']) ?></td>
                                <td><?= e($request['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>
