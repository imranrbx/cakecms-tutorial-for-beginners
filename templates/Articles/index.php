<h1>Articles List</h1>
<h3><?= $this->Html->link('Add New Article', ['action' => 'add']) ?></h3>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Crated</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) : ?>
        <tr>
            <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]); ?>
            </td>
            <td>
                <?= $article->created->format(DATE_RFC850); ?>
            </td>
            <td>
                <?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]); ?>
            </td>
            <td>
                <?= $this->Form->postLink(
                    'Delete',
                    ['action' => 'delete', $article->slug],
                    ['confirm' => 'Are You Sure ?']
                ); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>